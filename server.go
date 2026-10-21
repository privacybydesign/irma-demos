package main

import (
	"bytes"
	"embed"
	"io/fs"
	"net/http"
	"time"
)

// Only these paths are compiled into the binary, so nothing else from the
// repository can be served. assets/ holds yivi.js, which the image build
// copies in from node_modules.
//
//go:embed resources start_session.js demos/*/script.js
//go:embed all:assets
var publicFiles embed.FS

var startedAt = time.Now()

func newHandler(cfg config) http.Handler {
	sessions := newSessionStarter(cfg)
	pages := newPages(sessions)
	mux := http.NewServeMux()

	mux.HandleFunc("GET /{$}", pages.home)
	mux.HandleFunc("GET /demos", redirectHome)
	mux.HandleFunc("GET /demos/{$}", redirectHome)
	mux.HandleFunc("GET /demos/{slug}", pages.demoRoot)
	mux.HandleFunc("GET /demos/{slug}/", pages.demoPage)
	mux.HandleFunc("GET /demos/{slug}/demo.php", pages.standalone)

	mux.HandleFunc("GET "+startSessionPath, startSessionHandler(cfg, sessions))
	mux.HandleFunc("POST "+startSessionPath, startSessionHandler(cfg, sessions))
	mux.HandleFunc("POST "+nextSessionPath, nextSessionHandler(cfg))

	mux.HandleFunc("GET /resources/{file...}", func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, pages, "resources/"+r.PathValue("file"))
	})
	mux.HandleFunc("GET /demos/{slug}/script.js", func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, pages, "demos/"+r.PathValue("slug")+"/script.js")
	})
	mux.HandleFunc("GET /start_session.js", fixedFile(pages, "start_session.js"))
	mux.HandleFunc("GET /assets/yivi.js", fixedFile(pages, "assets/yivi.js"))

	mux.HandleFunc("/", pages.notFound)

	return mux
}

func redirectHome(w http.ResponseWriter, r *http.Request) {
	http.Redirect(w, r, "/", http.StatusFound)
}

func fixedFile(pages *pages, name string) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, pages, name)
	}
}

// servePublic never lists directories: ReadFile fails on them.
func servePublic(w http.ResponseWriter, r *http.Request, pages *pages, name string) {
	content, err := fs.ReadFile(publicFiles, name)
	if err != nil {
		pages.notFound(w, r)
		return
	}

	http.ServeContent(w, r, name, startedAt, bytes.NewReader(content))
}
