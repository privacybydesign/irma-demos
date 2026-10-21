package main

import (
	"net/http"
	"net/url"
)

const (
	homeSlug  = "home"
	demosPath = "/demos/"
)

// pageData is what every template gets. Content is specific to the kind of
// page and typed per kind; only the strings that hold markup of our own are
// template.HTML.
type pageData struct {
	Lang    lang
	Slug    string
	Title   string
	UI      ui
	Nav     []navLink
	Switch  langSwitch
	Content any
}

type navLink struct {
	URL    string
	Label  string
	Active bool
}

// langSwitch links to the same page in the other language.
type langSwitch struct {
	Label string
	URL   string
}

type demoContent struct {
	Page       page
	Sources    []sourceView
	Frame      frame
	Strings    any
	Request    string
	Standalone bool
}

// sourceView is a source of a wallet card with the words around it that make
// the list read as a sentence.
type sourceView struct {
	Label  string
	URL    string
	Before string
	After  string
}

type pages struct {
	render   *renderer
	sessions *sessionStarter
}

func newPages(sessions *sessionStarter) *pages {
	return &pages{render: newRenderer(), sessions: sessions}
}

func (p *pages) home(w http.ResponseWriter, r *http.Request) {
	language := parseLang(r.URL.Query().Get(queryLang))
	data := newPageData(r, language, homeSlug, homeLabel.in(language), homeStrings.in(language))

	renderPage(w, http.StatusOK, p.render.home, layoutTemplate, data)
}

func (p *pages) notFound(w http.ResponseWriter, r *http.Request) {
	language := parseLang(r.URL.Query().Get(queryLang))
	content := notFoundStrings.in(language)
	data := newPageData(r, language, "", content.Title, content)

	renderPage(w, http.StatusNotFound, p.render.notFound, layoutTemplate, data)
}

// demoRoot adds the trailing slash that the relative links of a demo page
// need.
func (p *pages) demoRoot(w http.ResponseWriter, r *http.Request) {
	d, ok := findDemo(r.PathValue("slug"))
	if !ok {
		p.notFound(w, r)
		return
	}

	target := url.URL{Path: demosPath + d.slug + "/", RawQuery: r.URL.RawQuery}
	http.Redirect(w, r, target.String(), http.StatusMovedPermanently)
}

// demoPage serves the description page of a demo with the demo embedded.
func (p *pages) demoPage(w http.ResponseWriter, r *http.Request) {
	d, ok := findDemo(r.PathValue("slug"))
	if !ok || r.URL.Path != demosPath+d.slug+"/" {
		p.notFound(w, r)
		return
	}

	language := parseLang(r.URL.Query().Get(queryLang))
	content := p.demoContent(d, language)
	data := newPageData(r, language, d.slug, d.label.in(language), content)

	renderPage(w, http.StatusOK, p.render.demos[d.slug], layoutTemplate, data)
}

// standalone serves the demo by itself, without the description page.
func (p *pages) standalone(w http.ResponseWriter, r *http.Request) {
	d, ok := findDemo(r.PathValue("slug"))
	if !ok || d.external() {
		p.notFound(w, r)
		return
	}

	language := parseLang(r.URL.Query().Get(queryLang))
	content := p.demoContent(d, language)
	content.Standalone = true
	data := newPageData(r, language, d.slug, d.label.in(language), content)

	renderPage(w, http.StatusOK, p.render.demos[d.slug], standaloneTemplate, data)
}

func (p *pages) demoContent(d demo, language lang) demoContent {
	request, _ := p.sessions.developerRequest(d.slug)
	content := d.page.in(language)

	return demoContent{
		Page:    content,
		Sources: sourceViews(content.Data.Sources, uiStrings.in(language)),
		Frame:   d.frame.in(language),
		Strings: d.strings.in(language),
		Request: request,
	}
}

func newPageData(r *http.Request, language lang, slug, title string, content any) pageData {
	return pageData{
		Lang:    language,
		Slug:    slug,
		Title:   title,
		UI:      uiStrings.in(language),
		Nav:     navLinks(language, slug),
		Switch:  switchLink(r, language),
		Content: content,
	}
}

func navLinks(language lang, active string) []navLink {
	query := "?" + queryLang + "=" + string(language)
	links := []navLink{{URL: "/" + query, Label: homeLabel.in(language), Active: active == homeSlug}}

	for _, d := range demos {
		links = append(links, navLink{
			URL:    demosPath + d.slug + "/" + query,
			Label:  d.label.in(language),
			Active: active == d.slug,
		})
	}

	return links
}

func switchLink(r *http.Request, language lang) langSwitch {
	other, label := langNL, "NL"
	if language == langNL {
		other, label = langEN, "EN"
	}

	query := r.URL.Query()
	query.Set(queryLang, string(other))

	return langSwitch{Label: label, URL: r.URL.EscapedPath() + "?" + query.Encode()}
}

func sourceViews(sources []source, text ui) []sourceView {
	last := len(sources) - 1
	views := make([]sourceView, len(sources))

	for i, s := range sources {
		views[i] = sourceView{Label: s.Label, URL: s.URL, After: ", "}

		if i == last {
			views[i].After = "."
		}
		if i == last && last > 0 {
			views[i].Before = text.Or
		}
	}

	return views
}
