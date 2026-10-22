package main

import (
	"fmt"
	"html"
	"html/template"
	"net/http"
	"net/http/httptest"
	"net/url"
	"reflect"
	"regexp"
	"strings"
	"testing"
)

const headerLocation = "Location"

var languages = []lang{langEN, langNL}

var jsEscape = regexp.MustCompile(`\\u([0-9a-fA-F]{4})|\\(["'/\\])`)

// plain undoes the JavaScript and HTML escaping of the page, so strings can be
// looked up wherever they ended up.
func plain(body string) string {
	body = jsEscape.ReplaceAllStringFunc(body, func(match string) string {
		if match[1] == 'u' {
			var code rune
			_, _ = fmt.Sscanf(match[2:], "%04x", &code)

			return string(code)
		}

		return match[1:]
	})

	return html.UnescapeString(body)
}

// stringsIn lists every non-empty string in a value of the content types.
func stringsIn(value reflect.Value) []string {
	switch value.Kind() {
	case reflect.String:
		if value.Len() == 0 {
			return nil
		}

		return []string{value.String()}
	case reflect.Interface, reflect.Pointer:
		if value.IsNil() {
			return nil
		}

		return stringsIn(value.Elem())
	case reflect.Slice:
		var found []string
		for i := range value.Len() {
			found = append(found, stringsIn(value.Index(i))...)
		}

		return found
	case reflect.Struct:
		var found []string
		for _, field := range value.Fields() {
			found = append(found, stringsIn(field)...)
		}

		return found
	}

	return nil
}

// optional lists the fields that may be empty.
var optional = map[string]bool{"source.URL": true, "page.Sidenotes": true}

func emptyFields(prefix string, value reflect.Value) []string {
	switch value.Kind() {
	case reflect.String:
		if value.Len() == 0 {
			return []string{prefix}
		}
	case reflect.Interface, reflect.Pointer:
		if !value.IsNil() {
			return emptyFields(prefix, value.Elem())
		}
	case reflect.Slice:
		var found []string
		for i := range value.Len() {
			found = append(found, emptyFields(fmt.Sprintf("%s[%d]", prefix, i), value.Index(i))...)
		}

		return found
	case reflect.Struct:
		var found []string
		for i := range value.NumField() {
			name := value.Type().Field(i).Name
			if optional[value.Type().Name()+"."+name] {
				continue
			}

			found = append(found, emptyFields(prefix+"."+name, value.Field(i))...)
		}

		return found
	}

	return nil
}

func TestEveryDemoIsComplete(t *testing.T) {
	for _, d := range demos {
		for _, language := range languages {
			name := d.slug + "/" + string(language)

			for what, value := range map[string]any{"page": d.page.in(language), "strings": d.strings.in(language)} {
				for _, field := range emptyFields(what, reflect.ValueOf(value)) {
					t.Errorf("%s: %s is empty", name, field)
				}
			}
			if d.label.in(language) == "" {
				t.Errorf("%s: label is empty", name)
			}
			if !d.external() {
				for _, field := range emptyFields("frame", reflect.ValueOf(d.frame.in(language))) {
					t.Errorf("%s: %s is empty", name, field)
				}
			}
		}
	}
}

func TestEveryDemoPageRenders(t *testing.T) {
	handler := newHandler(testConfig(""))

	for _, d := range demos {
		for _, language := range languages {
			t.Run(d.slug+"/"+string(language), func(t *testing.T) {
				rec := get(t, handler, demosPath+d.slug+"/?lang="+string(language))
				body := rec.Body.String()

				if rec.Code != http.StatusOK {
					t.Fatalf("status = %d", rec.Code)
				}
				if got := rec.Header().Get(headerContentType); got != contentTypeHTML {
					t.Errorf("Content-Type = %q", got)
				}

				for _, want := range []string{
					fmt.Sprintf(`<html lang="%s">`, language),
					"| Yivi Demos</title>",
					`class="site-header"`,
					`class="demo-nav"`,
				} {
					if !strings.Contains(body, want) {
						t.Errorf("page lacks %q", want)
					}
				}

				text := plain(body)
				if want := "<title>" + d.label.in(language) + " | Yivi Demos</title>"; !strings.Contains(text, want) {
					t.Errorf("page lacks %q", want)
				}

				content := stringsIn(reflect.ValueOf(d.page.in(language)))
				content = append(content, stringsIn(reflect.ValueOf(d.strings.in(language)))...)
				if !d.external() {
					content = append(content, stringsIn(reflect.ValueOf(d.frame.in(language)))...)
				}
				for _, want := range content {
					if !strings.Contains(text, want) {
						t.Errorf("page lacks the text %q", want)
					}
				}
			})
		}
	}
}

func TestEmbeddedHasBrowserFrame(t *testing.T) {
	handler := newHandler(testConfig(""))

	body := get(t, handler, "/demos/18plus/?lang=en").Body.String()

	for _, want := range []string{
		`<div class="demo-browser-bar" aria-hidden="true">`,
		`<span class="demo-browser-url">gamiverse.example/games/crimson-harbour-vi</span>`,
		`<section class="demo-main">`,
		"<h2>\n        Buy Crimson Harbour VI (18&#43;)\n    </h2>",
		`<script src="./script.js" defer></script>`,
		`let header_text = "Prove you’re older than 18";`,
		`let slug = "18plus";`,
	} {
		if !strings.Contains(body, want) {
			t.Errorf("page lacks %q", want)
		}
	}
	for _, unwanted := range []string{`class="stand-alone"`, `<main class="demo-main">`} {
		if strings.Contains(body, unwanted) {
			t.Errorf("page has %q", unwanted)
		}
	}
}

func TestEveryDemoStandalone(t *testing.T) {
	handler := newHandler(testConfig(""))

	for _, d := range demos {
		if d.external() {
			continue
		}

		for _, language := range languages {
			t.Run(d.slug+"/"+string(language), func(t *testing.T) {
				rec := get(t, handler, demosPath+d.slug+"/demo.php?lang="+string(language))
				body := rec.Body.String()

				if rec.Code != http.StatusOK {
					t.Fatalf("status = %d", rec.Code)
				}

				for _, want := range []string{
					fmt.Sprintf(`<html lang="%s">`, language),
					`<body class="stand-alone">`,
					`<main class="demo-main">`,
					`<script src="./script.js" defer></script>`,
					`<script src="/assets/yivi.js" defer></script>`,
					`<div id="yivi-web-form"></div>`,
				} {
					if !strings.Contains(body, want) {
						t.Errorf("page lacks %q", want)
					}
				}
				for _, unwanted := range []string{`class="site-header"`, `demo-browser-bar`, `class="demo-nav"`, `<section class="demo-main">`} {
					if strings.Contains(body, unwanted) {
						t.Errorf("page has %q", unwanted)
					}
				}

				text := plain(body)
				content := stringsIn(reflect.ValueOf(d.strings.in(language)))
				frame := d.frame.in(language)
				content = append(content, frame.Organisation, frame.Title, frame.Action, d.label.in(language))
				for _, want := range content {
					if !strings.Contains(text, want) {
						t.Errorf("page lacks the text %q", want)
					}
				}
			})
		}
	}
}

func TestStandaloneLangSwitch(t *testing.T) {
	handler := newHandler(testConfig(""))

	body := get(t, handler, "/demos/18plus/demo.php?lang=en").Body.String()

	if !strings.Contains(body, `<a href="/demos/18plus/demo.php?lang=nl">`) {
		t.Errorf("no link to the Dutch demo:\n%s", body)
	}
}

func TestExternalDemoLinksOut(t *testing.T) {
	handler := newHandler(testConfig(""))

	for _, language := range languages {
		body := get(t, handler, "/demos/boardingpass/?lang="+string(language)).Body.String()

		for _, want := range []string{
			`<div class="external-demo">`,
			`<a class="custom-button" href="https://boarding-pass.yivi.app" target="_blank">`,
		} {
			if !strings.Contains(body, want) {
				t.Errorf("%s: page lacks %q", language, want)
			}
		}
		for _, unwanted := range []string{"demo-browser-bar", `id="yivi-web-form"`, "script.js", `id="copy-request"`, `id="reload"`} {
			if strings.Contains(body, unwanted) {
				t.Errorf("%s: page has %q", language, unwanted)
			}
		}
	}

	for _, target := range []string{"/demos/boardingpass/demo.php", "/demos/boardingpass/script.js"} {
		if rec := get(t, handler, target); rec.Code != http.StatusNotFound {
			t.Errorf("GET %s = %d, want 404", target, rec.Code)
		}
	}
}

func TestPagesShowRequest(t *testing.T) {
	sessions := newSessionStarter(testConfig(""))
	handler := newHandler(testConfig(""))

	for _, d := range demos {
		if d.external() {
			continue
		}

		request, ok := sessions.developerRequest(d.slug)
		if !ok {
			t.Errorf("%s: no request", d.slug)
			continue
		}

		body := get(t, handler, demosPath+d.slug+"/?lang=en").Body.String()
		if want := `<pre><code id="request">` + template.HTMLEscapeString(request) + `</code></pre>`; !strings.Contains(body, want) {
			t.Errorf("%s: page lacks the request", d.slug)
		}
	}
}

func TestHomePage(t *testing.T) {
	handler := newHandler(testConfig(""))

	tests := map[string][]string{
		"/":                {`<html lang="en">`, "<h1>Demos</h1>", "<title>Home | Yivi Demos</title>", `<a href="https://yivi.app/#download">Yivi app</a>`},
		"/?lang=en":        {`<html lang="en">`, "<h1>Demos</h1>"},
		"/?lang=nl":        {`<html lang="nl">`, "<h1>Demo’s</h1>", `<a href="https://yivi.app/#download">Yivi-app</a>`},
		"/?lang=fr":        {`<html lang="en">`},
		"/?lang=%3Cb%3E":   {`<html lang="en">`},
		"/?lang=nl&lang=x": {`<html lang="nl">`},
	}
	for target, wants := range tests {
		rec := get(t, handler, target)

		if rec.Code != http.StatusOK {
			t.Errorf("GET %s = %d", target, rec.Code)
		}
		for _, want := range wants {
			if !strings.Contains(rec.Body.String(), want) {
				t.Errorf("GET %s lacks %q", target, want)
			}
		}
	}
}

func TestNavMarksActivePage(t *testing.T) {
	handler := newHandler(testConfig(""))

	body := get(t, handler, "/demos/petition/?lang=nl").Body.String()

	if got := strings.Count(body, `aria-current="page"`); got != 1 {
		t.Errorf("%d active entries, want 1", got)
	}
	if !strings.Contains(body, `<li class="active">`+"\n"+`                    <a href="/demos/petition/?lang=nl" aria-current="page">`) {
		t.Errorf("petition is not the active entry:\n%s", body)
	}
	for _, d := range demos {
		if want := `href="/demos/` + d.slug + `/?lang=nl"`; !strings.Contains(body, want) {
			t.Errorf("navigation lacks %s", want)
		}
	}
	if !strings.Contains(body, `href="/?lang=nl"`) {
		t.Error("navigation lacks the home page")
	}
}

func TestLanguageSwitcher(t *testing.T) {
	handler := newHandler(testConfig(""))

	tests := map[string]string{
		"/":                           `<a href="/?lang=nl">`,
		"/?lang=nl":                   `<a href="/?lang=en">`,
		"/demos/mail/?lang=en":        `<a href="/demos/mail/?lang=nl">`,
		"/demos/mail/?lang=nl&x=1":    `<a href="/demos/mail/?lang=en&amp;x=1">`,
		"/demos/mail/?x=1%2B2&lang=x": `<a href="/demos/mail/?lang=nl&amp;x=1%2B2">`,
	}
	for target, want := range tests {
		if body := get(t, handler, target).Body.String(); !strings.Contains(body, want) {
			t.Errorf("GET %s lacks %s", target, want)
		}
	}
}

func TestRequestDataIsEscaped(t *testing.T) {
	handler := newHandler(testConfig(""))

	attack := `"><script>alert(1)</script>`
	targets := []string{
		"/?lang=" + url.QueryEscape(attack) + "&x=" + url.QueryEscape(attack),
		"/demos/mail/?lang=" + url.QueryEscape(attack) + "&" + url.QueryEscape(attack) + "=1",
		"/demos/mail/demo.php?x=" + url.QueryEscape(attack),
		"/" + url.PathEscape(attack) + "/?x=" + url.QueryEscape(attack),
		"/demos/" + url.PathEscape(attack) + "/",
	}
	for _, target := range targets {
		rec := get(t, handler, target)
		body := rec.Body.String()

		if strings.Contains(body, "<script>alert") || strings.Contains(body, `"><script`) {
			t.Errorf("GET %s echoes request data unescaped", target)
		}
	}
}

func TestRedirects(t *testing.T) {
	handler := newHandler(testConfig(""))

	tests := []struct {
		target   string
		status   int
		location string
	}{
		{"/demos/18plus", http.StatusMovedPermanently, "/demos/18plus/"},
		{"/demos/18plus?lang=nl", http.StatusMovedPermanently, "/demos/18plus/?lang=nl"},
		{"/demos/18plus?lang=nl&x=a%20b", http.StatusMovedPermanently, "/demos/18plus/?lang=nl&x=a%20b"},
		{"/demos", http.StatusFound, "/"},
		{"/demos/", http.StatusFound, "/"},
		{"/demos/?lang=nl", http.StatusFound, "/"},
	}
	for _, test := range tests {
		rec := get(t, handler, test.target)

		if rec.Code != test.status || rec.Header().Get(headerLocation) != test.location {
			t.Errorf("GET %s = %d %q, want %d %q", test.target, rec.Code, rec.Header().Get(headerLocation), test.status, test.location)
		}
	}
}

func TestUnknownPagesAreNotFound(t *testing.T) {
	handler := newHandler(testConfig(""))

	targets := []string{
		"/nope",
		"/nope/",
		"/nope/deeper/still",
		"/demos/nope",
		"/demos/nope/",
		"/demos/nope/demo.php",
		"/demos/18plus/nope",
		"/demos/18plus/index.php",
		"/demos/18plus/en.php",
		"/demos/18plus/demo.html",
		"/index.php",
		"/resources/missing.css",
		"/resources/",
		"/.git/config",
		"/vendor/",
		"/node_modules/",
		"/composer.json",
	}
	for _, target := range targets {
		rec := get(t, handler, target)

		if rec.Code != http.StatusNotFound {
			t.Errorf("GET %s = %d, want 404", target, rec.Code)
		}
		if !strings.Contains(rec.Body.String(), "<h1>Page not found (404)</h1>") {
			t.Errorf("GET %s did not give the not found page", target)
		}
	}
}

func TestNotFoundPage(t *testing.T) {
	handler := newHandler(testConfig(""))

	tests := map[string][]string{
		"/nope/":         {`<html lang="en">`, "<title>Page not found (404) | Yivi Demos</title>", "open an issue on Github</a>", `<a href="/nope/?lang=nl">`},
		"/nope/?lang=nl": {`<html lang="nl">`, "<title>Pagina niet gevonden (404) | Yivi Demos</title>", "maak een issue aan op Github</a>", `<a href="/nope/?lang=en">`},
	}
	for target, wants := range tests {
		rec := get(t, handler, target)

		if rec.Code != http.StatusNotFound {
			t.Errorf("GET %s = %d", target, rec.Code)
		}
		for _, want := range wants {
			if !strings.Contains(rec.Body.String(), want) {
				t.Errorf("GET %s lacks %q", target, want)
			}
		}
		if strings.Contains(rec.Body.String(), "aria-current") {
			t.Errorf("GET %s marks a navigation entry as active", target)
		}
	}
}

func TestPagesAnswerHEAD(t *testing.T) {
	handler := newHandler(testConfig(""))

	for _, target := range []string{"/", "/demos/18plus/", "/demos/18plus/demo.php"} {
		rec := httptest.NewRecorder()
		handler.ServeHTTP(rec, httptest.NewRequest(http.MethodHead, target, nil))

		if rec.Code != http.StatusOK {
			t.Errorf("HEAD %s = %d, want 200", target, rec.Code)
		}
	}
}

func TestSourceViewsSentence(t *testing.T) {
	text := uiStrings.EN

	tests := []struct {
		name    string
		sources []source
		want    []sourceView
	}{
		{"one", []source{{Label: "passport"}}, []sourceView{{Label: "passport", After: "."}}},
		{
			"two",
			[]source{{Label: "passport"}, {Label: "BRP", URL: "https://brp.example"}},
			[]sourceView{{Label: "passport", After: ", "}, {Label: "BRP", URL: "https://brp.example", Before: "or ", After: "."}},
		},
		{
			"three",
			[]source{{Label: "a"}, {Label: "b"}, {Label: "c"}},
			[]sourceView{{Label: "a", After: ", "}, {Label: "b", After: ", "}, {Label: "c", Before: "or ", After: "."}},
		},
	}
	for _, test := range tests {
		if got := sourceViews(test.sources, text); !reflect.DeepEqual(got, test.want) {
			t.Errorf("%s: got %+v, want %+v", test.name, got, test.want)
		}
	}
}

func TestPageListsSources(t *testing.T) {
	handler := newHandler(testConfig(""))

	body := get(t, handler, "/demos/18plus/?lang=en").Body.String()

	want := `The personal data card can come from: <a href="https://yivi.nijmegen.nl/login" target="_blank">the Dutch resident registration (BRP)</a>, passport, driver’s license, or identity card.`
	if !strings.Contains(body, want) {
		t.Errorf("page lacks %q", want)
	}
}

func TestOnlyOwnMarkupIsTrusted(t *testing.T) {
	handler := newHandler(testConfig(""))

	body := get(t, handler, "/demos/petition/?lang=en").Body.String()

	if !strings.Contains(body, `<a href='../chained'>chained sessions</a>`) {
		t.Error("the markup of the petition sidenotes was escaped")
	}
	if !strings.Contains(body, `<strong id="city"></strong>`) {
		t.Error("the markup of the petition result was escaped")
	}
}
