package main

import (
	"bytes"
	"embed"
	"html/template"
	"log/slog"
	"net/http"
)

//go:embed templates demos/*/demo.html
var templateFiles embed.FS

const (
	layoutTemplate     = "layout"
	standaloneTemplate = "standalone"
	contentTypeHTML    = "text/html; charset=utf-8"
	emptyBody          = `{{define "body"}}{{end}}`
)

// renderer holds one parsed template set per kind of page. They are parsed at
// startup, so a broken template stops the server instead of a request.
type renderer struct {
	home     *template.Template
	notFound *template.Template
	demos    map[string]*template.Template
}

func newRenderer() *renderer {
	shared := template.Must(template.ParseFS(templateFiles, "templates/layout.html", "templates/demo_frame.html"))
	r := &renderer{
		home:     mustExtend(shared, "templates/home.html"),
		notFound: mustExtend(shared, "templates/not_found.html"),
		demos:    make(map[string]*template.Template, len(demos)),
	}

	for _, d := range demos {
		set := mustExtend(shared, "templates/demo_page.html")
		if d.external() {
			template.Must(set.Parse(emptyBody))
		} else {
			template.Must(set.ParseFS(templateFiles, "demos/"+d.slug+"/demo.html"))
		}

		r.demos[d.slug] = set
	}

	return r
}

func mustExtend(base *template.Template, file string) *template.Template {
	set := template.Must(base.Clone())

	return template.Must(set.ParseFS(templateFiles, file))
}

// renderPage renders the named template completely before sending anything,
// so a failing template gives a clean 500 and not half a page.
func renderPage(w http.ResponseWriter, status int, set *template.Template, name string, data pageData) {
	var page bytes.Buffer
	if err := set.ExecuteTemplate(&page, name, data); err != nil {
		slog.Error("rendering page failed", "error", err)
		http.Error(w, msgServerError, http.StatusInternalServerError)

		return
	}

	w.Header().Set(headerContentType, contentTypeHTML)
	w.WriteHeader(status)
	_, _ = page.WriteTo(w)
}
