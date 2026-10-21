package main

import (
	"crypto/rsa"
	"crypto/x509"
	"encoding/json"
	"encoding/pem"
	"net/http"
	"net/http/httptest"
	"regexp"
	"strings"
	"testing"
	"time"

	"github.com/golang-jwt/jwt/v5"
)

const (
	chainedURL  = "/get_session_request.php"
	petitionURL = "/get_session_request.php?type=petition-signature&lang="
)

var memberID = regexp.MustCompile(`^[1-9][0-9]{10}$`)

func disclosed(value string) []any {
	return []any{[]any{map[string]any{"id": "pbdf.pbdf.x.y", "status": "PRESENT", "rawvalue": value}}}
}

func validClaims(disclosedValue string) jwt.MapClaims {
	now := time.Now()

	return jwt.MapClaims{
		"iss":       "irmaserver",
		"sub":       "disclosing_result",
		"iat":       now.Unix(),
		"exp":       now.Add(2 * time.Minute).Unix(),
		"status":    "DONE",
		"disclosed": disclosed(disclosedValue),
	}
}

func signRS256(t *testing.T, key *rsa.PrivateKey, claims jwt.MapClaims) string {
	t.Helper()

	token, err := jwt.NewWithClaims(jwt.SigningMethodRS256, claims).SignedString(key)
	if err != nil {
		t.Fatal(err)
	}

	return token
}

type callbackFixture struct {
	handler http.Handler
	key     *rsa.PrivateKey
}

func newCallbackFixture(t *testing.T) callbackFixture {
	t.Helper()

	key := newTestKey(t)
	cfg := testConfig("")
	cfg.serverKey = &key.PublicKey

	return callbackFixture{handler: newHandler(cfg), key: key}
}

func (f callbackFixture) post(target, body string) *httptest.ResponseRecorder {
	rec := httptest.NewRecorder()
	f.handler.ServeHTTP(rec, httptest.NewRequest(http.MethodPost, target, strings.NewReader(body)))

	return rec
}

func decode(t *testing.T, rec *httptest.ResponseRecorder) map[string]any {
	t.Helper()

	var value map[string]any
	if err := json.Unmarshal(rec.Body.Bytes(), &value); err != nil {
		t.Fatalf("response is not a JSON object: %v\n%s", err, rec.Body)
	}

	return value
}

func TestCallbackIssuesMembership(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(chainedURL, signRS256(t, f.key, validClaims("Jan Jansen")))

	if rec.Code != http.StatusOK {
		t.Fatalf("status = %d, body %q", rec.Code, rec.Body)
	}
	if got := rec.Header().Get(headerAllowOrigin); got != testBaseURL {
		t.Errorf("%s = %q", headerAllowOrigin, got)
	}

	response := decode(t, rec)
	if response["@context"] != "https://irma.app/ld/request/issuance/v2" {
		t.Errorf("@context = %v", response["@context"])
	}

	credentials := response["credentials"].([]any)
	if len(credentials) != 1 {
		t.Fatalf("credentials = %v", credentials)
	}

	card := credentials[0].(map[string]any)
	if card["credential"] != "pbdf.pbdf.irmatube" {
		t.Errorf("credential = %v", card["credential"])
	}

	attributes := card["attributes"].(map[string]any)
	if attributes["fullname"] != "Jan Jansen" || attributes["type"] != "premium" {
		t.Errorf("attributes = %v", attributes)
	}
	if id, _ := attributes["id"].(string); !memberID.MatchString(id) {
		t.Errorf("id = %v, want 11 digits that do not start with 0", attributes["id"])
	}

	validity := time.Unix(int64(card["validity"].(float64)), 0)
	if want := time.Now().AddDate(0, 6, 0); validity.Sub(want).Abs() > time.Minute {
		t.Errorf("validity = %v, want about %v", validity, want)
	}
}

func TestMembershipKeyOrder(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(chainedURL, signRS256(t, f.key, validClaims("Jan Jansen")))

	pattern := `^\{"@context":"[^"]+","credentials":\[\{"credential":"[^"]+","validity":\d+,"attributes":\{"fullname":"Jan Jansen","type":"premium","id":"\d{11}"\}\}\]\}\n?$`
	if !regexp.MustCompile(pattern).MatchString(rec.Body.String()) {
		t.Errorf("unexpected response layout: %s", rec.Body)
	}
}

func TestNextSessionIDsDiffer(t *testing.T) {
	f := newCallbackFixture(t)
	token := signRS256(t, f.key, validClaims("Jan Jansen"))

	seen := map[string]bool{}
	for range 20 {
		body := f.post(chainedURL, token).Body.String()
		seen[body] = true
	}

	if len(seen) < 2 {
		t.Error("member ids are not random")
	}
}

func TestMembershipJohnDoe(t *testing.T) {
	f := newCallbackFixture(t)

	for name, claims := range map[string]jwt.MapClaims{
		"empty value": validClaims(""),
		"no disclosed": func() jwt.MapClaims {
			c := validClaims("")
			delete(c, "disclosed")

			return c
		}(),
		"empty disclosed": func() jwt.MapClaims {
			c := validClaims("")
			c["disclosed"] = []any{}

			return c
		}(),
	} {
		rec := f.post(chainedURL, signRS256(t, f.key, claims))

		if rec.Code != http.StatusOK || !strings.Contains(rec.Body.String(), `"fullname":"John Doe"`) {
			t.Errorf("%s: status %d, body %s", name, rec.Code, rec.Body)
		}
	}
}

func TestNextSessionPetition(t *testing.T) {
	f := newCallbackFixture(t)
	token := signRS256(t, f.key, validClaims("Nijmegen"))

	tests := map[string]string{
		"en": "I sign this petition to turn the Main Square in Nijmegen into a park",
		"nl": "Ik onderteken deze petitie om het Hoofdplein in Nijmegen in een park te veranderen",
	}
	for language, message := range tests {
		rec := f.post(petitionURL+language, token)

		if rec.Code != http.StatusOK {
			t.Fatalf("%s: status = %d, body %q", language, rec.Code, rec.Body)
		}

		want := `{"@context":"https://irma.app/ld/request/signature/v2","message":"` + message +
			`","disclose":[[["pbdf.gemeente.personalData.initials","pbdf.gemeente.personalData.familyname"]]]}`
		if got := strings.TrimSpace(rec.Body.String()); got != want {
			t.Errorf("%s:\ngot  %s\nwant %s", language, got, want)
		}
	}
}

func TestPetitionEscapesCity(t *testing.T) {
	f := newCallbackFixture(t)
	token := signRS256(t, f.key, validClaims(`"Quote" <b>&`))

	rec := f.post(petitionURL+"en", token)

	var response struct{ Message string }
	if err := json.Unmarshal(rec.Body.Bytes(), &response); err != nil {
		t.Fatalf("response is not JSON: %v\n%s", err, rec.Body)
	}
	if !strings.Contains(response.Message, `in "Quote" <b>& into`) {
		t.Errorf("message = %q", response.Message)
	}
}

func TestPetitionNeedsCity(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(petitionURL+"en", signRS256(t, f.key, validClaims("")))

	if rec.Code != http.StatusBadRequest {
		t.Errorf("status = %d, want 400", rec.Code)
	}
}

func TestPetitionUnknownLang(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(petitionURL+"fr", signRS256(t, f.key, validClaims("Nijmegen")))

	if rec.Code != http.StatusOK || !strings.Contains(rec.Body.String(), "I sign this petition") {
		t.Errorf("status %d, body %s", rec.Code, rec.Body)
	}
}

func TestCallbackPaddedToken(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(chainedURL, "\n"+signRS256(t, f.key, validClaims("Jan"))+"\r\n")

	if rec.Code != http.StatusOK {
		t.Errorf("status = %d, want 200", rec.Code)
	}
}

func TestCallbackRejectsBadJWT(t *testing.T) {
	f := newCallbackFixture(t)
	otherKey := newTestKey(t)

	publicPEM := func() string {
		der, err := x509.MarshalPKIXPublicKey(&f.key.PublicKey)
		if err != nil {
			t.Fatal(err)
		}

		return string(pem.EncodeToMemory(&pem.Block{Type: "PUBLIC KEY", Bytes: der}))
	}()

	sign := func(method jwt.SigningMethod, key any, claims jwt.MapClaims) string {
		token, err := jwt.NewWithClaims(method, claims).SignedString(key)
		if err != nil {
			t.Fatal(err)
		}

		return token
	}

	with := func(name string, value any) jwt.MapClaims {
		claims := validClaims("Jan Jansen")
		if value == nil {
			delete(claims, name)
		} else {
			claims[name] = value
		}

		return claims
	}

	now := time.Now()
	tests := map[string]string{
		"HS256 signed with the public key": sign(jwt.SigningMethodHS256, []byte(publicPEM), validClaims("Jan Jansen")),
		"alg none":                         sign(jwt.SigningMethodNone, jwt.UnsafeAllowNoneSignatureType, validClaims("Jan Jansen")),
		"RS384 with the right key":         sign(jwt.SigningMethodRS384, f.key, validClaims("Jan Jansen")),
		"PS256 with the right key":         sign(jwt.SigningMethodPS256, f.key, validClaims("Jan Jansen")),
		"RS256 with another key":           signRS256(t, otherKey, validClaims("Jan Jansen")),
		"expired":                          signRS256(t, f.key, with("exp", now.Add(-time.Minute).Unix())),
		"no exp":                           signRS256(t, f.key, with("exp", nil)),
		"not valid yet":                    signRS256(t, f.key, with("nbf", now.Add(time.Hour).Unix())),
		"issued in the future":             signRS256(t, f.key, with("iat", now.Add(time.Hour).Unix())),
		"tampered payload":                 tamper(signRS256(t, f.key, validClaims("Jan Jansen"))),
		"not a JWT":                        "Jan Jansen",
		"JSON instead of a JWT":            `{"disclosed":[[{"rawvalue":"Jan Jansen"}]]}`,
		"empty":                            "",
	}
	for name, token := range tests {
		for _, target := range []string{chainedURL, petitionURL + "en"} {
			rec := f.post(target, token)

			if rec.Code != http.StatusForbidden {
				t.Errorf("%s (%s): status = %d, want 403, body %q", name, target, rec.Code, rec.Body)
			}
			if strings.Contains(rec.Body.String(), "credentials") || strings.Contains(rec.Body.String(), "message") {
				t.Errorf("%s (%s): a request was returned: %s", name, target, rec.Body)
			}
		}
	}
}

// tamper swaps the payload of a token for one with other claims, keeping the
// original signature.
func tamper(token string) string {
	parts := strings.Split(token, ".")
	forged := jwt.NewWithClaims(jwt.SigningMethodNone, validClaims("Mallory"))
	forgedToken, _ := forged.SignedString(jwt.UnsafeAllowNoneSignatureType)

	parts[1] = strings.Split(forgedToken, ".")[1]

	return strings.Join(parts, ".")
}

func TestCallbackOnlyPOST(t *testing.T) {
	f := newCallbackFixture(t)

	for _, method := range []string{http.MethodGet, http.MethodPut, http.MethodDelete} {
		rec := httptest.NewRecorder()
		f.handler.ServeHTTP(rec, httptest.NewRequest(method, chainedURL, nil))

		if rec.Code != http.StatusNotFound && rec.Code != http.StatusMethodNotAllowed {
			t.Errorf("%s = %d, want 404 or 405", method, rec.Code)
		}
	}
}

func TestCallbackRejectsHugeBody(t *testing.T) {
	f := newCallbackFixture(t)

	rec := f.post(chainedURL, strings.Repeat("a", maxCallbackBody+1))

	if rec.Code != http.StatusBadRequest {
		t.Errorf("status = %d, want 400", rec.Code)
	}
}
