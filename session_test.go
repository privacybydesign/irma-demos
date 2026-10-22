package main

import (
	"encoding/json"
	"io"
	"net/http"
	"net/http/httptest"
	"os"
	"path/filepath"
	"reflect"
	"strings"
	"testing"
	"time"
)

const (
	testBaseURL = "https://privacybydesign.foundation"
	testToken   = "irma-api-token"
	testResult  = `{"sessionPtr":{"u":"https://irma.example/irma/abc","irmaqr":"disclosing"},"token":"abc"}`
)

// The goldens were produced by the PHP site on this day.
var goldenDay = time.Date(2026, time.October, 21, 10, 0, 0, 0, time.UTC)

type recordedRequest struct {
	method        string
	path          string
	authorization string
	contentType   string
	body          []byte
}

// fakeIrma answers every session request with status and body, and records
// the last request it got.
func fakeIrma(t *testing.T, status int, body string) (*httptest.Server, *recordedRequest) {
	t.Helper()

	recorded := &recordedRequest{}
	server := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		recorded.method = r.Method
		recorded.path = r.URL.Path
		recorded.authorization = r.Header.Get(headerAuthorization)
		recorded.contentType = r.Header.Get(headerContentType)
		recorded.body, _ = io.ReadAll(r.Body)

		w.WriteHeader(status)
		_, _ = io.WriteString(w, body)
	}))
	t.Cleanup(server.Close)

	return server, recorded
}

func testConfig(irmaURL string) config {
	return config{
		irmaServerURL:      irmaURL,
		apiToken:           testToken,
		baseURL:            testBaseURL,
		irmatubeCredential: "pbdf.pbdf.irmatube",
		irmatubeNextURL:    testBaseURL + "/get_session_request.php",
	}
}

func readGolden(t *testing.T, name string) []byte {
	t.Helper()

	content, err := os.ReadFile(filepath.Join("testdata", name))
	if err != nil {
		t.Fatal(err)
	}

	return content
}

func goldenIDs(t *testing.T) []string {
	t.Helper()

	files, err := filepath.Glob("testdata/developer/*.json")
	if err != nil || len(files) == 0 {
		t.Fatalf("no developer goldens: %v", err)
	}

	ids := make([]string, len(files))
	for i, file := range files {
		ids[i] = strings.TrimSuffix(filepath.Base(file), ".json")
	}

	return ids
}

func sameJSON(t *testing.T, got, want []byte) bool {
	t.Helper()

	var gotValue, wantValue any
	if err := json.Unmarshal(got, &gotValue); err != nil {
		t.Fatalf("got is not JSON: %v\n%s", err, got)
	}
	if err := json.Unmarshal(want, &wantValue); err != nil {
		t.Fatal(err)
	}

	return reflect.DeepEqual(gotValue, wantValue)
}

func TestEveryRequestHasGoldens(t *testing.T) {
	requests := newRequests(testConfig(""), goldenDay)

	ids := goldenIDs(t)
	if len(ids) != len(requests) {
		t.Errorf("%d requests but %d goldens", len(requests), len(ids))
	}
	for _, id := range ids {
		if _, ok := requests[id]; !ok {
			t.Errorf("golden %s has no request", id)
		}
	}
}

func TestStartPostsEveryRequest(t *testing.T) {
	irma, recorded := fakeIrma(t, http.StatusOK, testResult)
	handler := newHandler(testConfig(irma.URL))

	for _, id := range goldenIDs(t) {
		for _, language := range []lang{langEN, langNL} {
			t.Run(id+"/"+string(language), func(t *testing.T) {
				rec := get(t, handler, "/start_session.php?type="+id+"&lang="+string(language))

				if rec.Code != http.StatusOK {
					t.Fatalf("status = %d, body %q", rec.Code, rec.Body)
				}
				if rec.Body.String() != testResult {
					t.Errorf("response = %q, want the IRMA server's answer", rec.Body)
				}
				if got := rec.Header().Get(headerAllowOrigin); got != testBaseURL {
					t.Errorf("%s = %q", headerAllowOrigin, got)
				}

				if recorded.method != http.MethodPost || recorded.path != "/session" {
					t.Errorf("IRMA server got %s %s", recorded.method, recorded.path)
				}
				if recorded.authorization != testToken {
					t.Errorf("Authorization = %q", recorded.authorization)
				}
				if recorded.contentType != contentTypeJSON {
					t.Errorf("Content-Type = %q", recorded.contentType)
				}

				want := readGolden(t, "start/"+id+"."+string(language)+".json")
				if !sameJSON(t, recorded.body, want) {
					t.Errorf("posted %s\nwant   %s", recorded.body, want)
				}
			})
		}
	}
}

func TestStartSessionPostsLiveDate(t *testing.T) {
	irma, recorded := fakeIrma(t, http.StatusOK, testResult)
	sessions := newSessionStarter(testConfig(irma.URL))
	sessions.now = func() time.Time { return time.Date(2027, time.March, 5, 23, 59, 0, 0, time.UTC) }

	if _, err := sessions.start(t.Context(), "signature", langEN); err != nil {
		t.Fatal(err)
	}

	if !strings.Contains(string(recorded.body), "today, 05 / 03 / 2027, the student") {
		t.Errorf("posted %s", recorded.body)
	}
}

func TestDeveloperJSONMatchesPHP(t *testing.T) {
	sessions := newSessionStarter(testConfig(""))
	sessions.now = func() time.Time { return goldenDay }

	for _, id := range goldenIDs(t) {
		t.Run(id, func(t *testing.T) {
			got, ok := sessions.developerRequest(id)
			if !ok {
				t.Fatal("no request")
			}

			if want := string(readGolden(t, "developer/"+id+".json")); got != want {
				t.Errorf("developer JSON differs from PHP\ngot:\n%s\nwant:\n%s", got, want)
			}
		})
	}
}

func TestNoDeveloperRequest(t *testing.T) {
	sessions := newSessionStarter(testConfig(""))

	for _, slug := range []string{"boardingpass", "nope", ""} {
		if got, ok := sessions.developerRequest(slug); ok {
			t.Errorf("developerRequest(%q) = %q, want none", slug, got)
		}
	}
}

func TestStartRejectsBadRequests(t *testing.T) {
	irma, recorded := fakeIrma(t, http.StatusOK, testResult)
	handler := newHandler(testConfig(irma.URL))

	targets := []string{
		"/start_session.php",
		"/start_session.php?type=18plus",
		"/start_session.php?lang=en",
		"/start_session.php?type=nope&lang=en",
		"/start_session.php?type=&lang=en",
		"/start_session.php?type=boardingpass&lang=en",
		"/start_session.php?type=__proto__&lang=en",
	}
	for _, target := range targets {
		rec := get(t, handler, target)

		if rec.Code != http.StatusBadRequest {
			t.Errorf("GET %s = %d, want 400", target, rec.Code)
		}
	}

	if recorded.method != "" {
		t.Errorf("the IRMA server was called for an invalid request: %s", recorded.body)
	}
}

func TestStartUnknownLangIsEnglish(t *testing.T) {
	irma, recorded := fakeIrma(t, http.StatusOK, testResult)
	handler := newHandler(testConfig(irma.URL))

	for _, language := range []string{"fr", "<script>", "NL"} {
		get(t, handler, "/start_session.php?type=signature&lang="+language)

		want := "Hereby I declare"
		if language == "NL" {
			want = "Hierbij verklaar ik"
		}
		if !strings.Contains(string(recorded.body), want) {
			t.Errorf("lang=%s posted %s, want %q", language, recorded.body, want)
		}
	}
}

func TestStartSessionAcceptsPOST(t *testing.T) {
	irma, _ := fakeIrma(t, http.StatusOK, testResult)
	handler := newHandler(testConfig(irma.URL))

	rec := httptest.NewRecorder()
	handler.ServeHTTP(rec, httptest.NewRequest(http.MethodPost, "/start_session.php?type=18plus&lang=en", nil))

	if rec.Code != http.StatusOK {
		t.Errorf("POST = %d, want 200", rec.Code)
	}
}

func TestStartFailsWhenIrmaFails(t *testing.T) {
	statuses := []int{
		http.StatusBadRequest,
		http.StatusUnauthorized,
		http.StatusForbidden,
		http.StatusInternalServerError,
		http.StatusMovedPermanently,
	}
	for _, status := range statuses {
		irma, _ := fakeIrma(t, status, `{"error":"nope"}`)
		rec := get(t, newHandler(testConfig(irma.URL)), "/start_session.php?type=18plus&lang=en")

		if rec.Code != http.StatusInternalServerError {
			t.Errorf("IRMA status %d: got %d, want 500", status, rec.Code)
		}
		if strings.Contains(rec.Body.String(), "nope") {
			t.Errorf("IRMA error leaked to the browser: %q", rec.Body)
		}
	}
}

func TestStartEmptyOrDownIrma(t *testing.T) {
	empty, _ := fakeIrma(t, http.StatusOK, "")
	unreachable, _ := fakeIrma(t, http.StatusOK, testResult)
	unreachable.Close()

	for name, url := range map[string]string{"empty": empty.URL, "unreachable": unreachable.URL} {
		rec := get(t, newHandler(testConfig(url)), "/start_session.php?type=18plus&lang=en")

		if rec.Code != http.StatusInternalServerError {
			t.Errorf("%s IRMA server: got %d, want 500", name, rec.Code)
		}
	}
}

func TestStartOmitsEmptyToken(t *testing.T) {
	irma, recorded := fakeIrma(t, http.StatusOK, testResult)
	cfg := testConfig(irma.URL)
	cfg.apiToken = ""

	get(t, newHandler(cfg), "/start_session.php?type=18plus&lang=en")

	if recorded.method == "" || recorded.authorization != "" {
		t.Errorf("Authorization = %q", recorded.authorization)
	}
}
