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
	mux := http.NewServeMux()

	mux.HandleFunc("GET /resources/{file...}", func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, "resources/"+r.PathValue("file"))
	})
	mux.HandleFunc("GET /demos/{slug}/script.js", func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, "demos/"+r.PathValue("slug")+"/script.js")
	})
	sessions := newSessionStarter(cfg)
	mux.HandleFunc("GET /start_session.php", startSessionHandler(cfg, sessions))
	mux.HandleFunc("POST /start_session.php", startSessionHandler(cfg, sessions))
	mux.HandleFunc("POST /get_session_request.php", nextSessionHandler(cfg))

	mux.HandleFunc("GET /start_session.js", fixedFile("start_session.js"))
	mux.HandleFunc("GET /assets/yivi.js", fixedFile("assets/yivi.js"))
	mux.HandleFunc("/", notFound)

	return mux
}

func fixedFile(name string) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		servePublic(w, r, name)
	}
}

// servePublic never lists directories: ReadFile fails on them.
func servePublic(w http.ResponseWriter, r *http.Request, name string) {
	content, err := fs.ReadFile(publicFiles, name)
	if err != nil {
		notFound(w, r)
		return
	}

	http.ServeContent(w, r, name, startedAt, bytes.NewReader(content))
}

func notFound(w http.ResponseWriter, r *http.Request) {
	http.NotFound(w, r)
}
