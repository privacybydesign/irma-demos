package main

import (
	"io/fs"
	"net/http"
	"net/http/httptest"
	"path"
	"path/filepath"
	"strings"
	"testing"
)

func get(t *testing.T, handler http.Handler, target string) *httptest.ResponseRecorder {
	t.Helper()

	rec := httptest.NewRecorder()
	handler.ServeHTTP(rec, httptest.NewRequest(http.MethodGet, target, nil))

	return rec
}

func TestPublicFilesAreServed(t *testing.T) {
	handler := newHandler(config{})

	tests := map[string]string{
		"/resources/vars.css":                                "text/css",
		"/resources/images/yivi-logo.svg":                    "image/svg+xml",
		"/resources/fonts/open-sans-v44-latin-regular.woff2": "font/woff2",
		"/start_session.js":                                  "text/javascript",
		"/demos/18plus/script.js":                            "text/javascript",
	}
	for target, contentType := range tests {
		rec := get(t, handler, target)

		if rec.Code != http.StatusOK {
			t.Errorf("GET %s = %d, want 200", target, rec.Code)
		}
		if got := rec.Header().Get(headerContentType); !strings.HasPrefix(got, contentType) {
			t.Errorf("GET %s Content-Type = %q, want %q", target, got, contentType)
		}
	}
}

func TestPrivateFilesAreNotServed(t *testing.T) {
	handler := newHandler(config{})

	targets := []string{
		"/.git/config",
		"/.git/HEAD",
		"/vendor/",
		"/vendor/autoload.php",
		"/node_modules/",
		"/node_modules/@privacybydesign/yivi-frontend/package.json",
		"/composer.json",
		"/composer.lock",
		"/package.json",
		"/go.mod",
		"/main.go",
		"/Dockerfile",
		"/.dockerignore",
		"/assets/.gitkeep",
		"/resources/",
		"/resources/images/",
		"/demos/",
		"/demos/18plus/en.php",
		"/demos/18plus/demo.html",
	}
	for _, target := range targets {
		if rec := get(t, handler, target); rec.Code == http.StatusOK {
			t.Errorf("GET %s = 200, want it not to be served", target)
		}
	}
}

// Every file in the repository except the public ones must stay unreachable,
// including files added later.
func TestOnlyPublicFilesServed(t *testing.T) {
	handler := newHandler(config{})

	err := filepath.WalkDir(".", func(name string, entry fs.DirEntry, err error) error {
		if err != nil {
			return err
		}
		if entry.IsDir() {
			switch entry.Name() {
			case ".git", "node_modules", "assets":
				return filepath.SkipDir
			}

			return nil
		}

		name = filepath.ToSlash(name)
		want := http.StatusNotFound
		if isPublicRepoFile(name) {
			want = http.StatusOK
		}

		if rec := get(t, handler, "/"+name); rec.Code != want {
			t.Errorf("GET /%s = %d, want %d", name, rec.Code, want)
		}

		return nil
	})
	if err != nil {
		t.Fatal(err)
	}
}

func isPublicRepoFile(name string) bool {
	if strings.HasPrefix(name, "resources/") || name == "start_session.js" {
		return true
	}

	matched, _ := path.Match("demos/*/script.js", name)

	return matched
}
