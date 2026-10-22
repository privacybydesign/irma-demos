package main

import "html/template"

// Issuer pages that several demos name as the source of a card.
const (
	brpLoginURL     = "https://yivi.nijmegen.nl/login"
	surfconextENURL = "https://saml-issuer.yivi.app/en/surfconext/"
	surfconextNLURL = "https://saml-issuer.yivi.app/nl/surfconext/"
)

// A demo is one entry of the list of demos: its description page and, unless
// it runs on its own site, the demo that is embedded in that page and served
// stand-alone.
type demo struct {
	slug    string
	label   localized[string]
	page    localized[page]
	frame   localized[frame]
	strings localized[any]
}

// external reports whether the demo runs on its own site instead of here.
func (d demo) external() bool {
	return d.page.EN.External != nil
}

// page is the text of a description page.
type page struct {
	Intro     string
	Benefits  []string
	Data      cardData
	External  *externalDemo
	More      *moreDemos
	Sidenotes template.HTML
}

type cardData struct {
	Description string
	Sources     []source
}

type source struct {
	Label string
	URL   string
}

// externalDemo replaces the embedded demo with a link to a demo that runs on
// its own site.
type externalDemo struct {
	Description string
	URL         string
	Action      string
}

type moreDemos struct {
	Description string
	Links       []link
}

type link struct {
	Label string
	URL   string
}

// frame is what every demo shows around its own markup: the fake site it
// pretends to be.
type frame struct {
	Organisation string
	URL          string
	Title        string
	Action       string
}

// both pairs the per-demo strings, a struct of its own for each demo.
func both[T any](en, nl T) localized[any] {
	return localized[any]{EN: en, NL: nl}
}

// demos lists the demos in the order of the navigation.
var demos = []demo{
	over18Demo,
	addressDemo,
	beingaliveDemo,
	ibanDemo,
	chainedDemo,
	mailDemo,
	domainDemo,
	signatureDemo,
	petitionDemo,
	studentDemo,
	vogDemo,
	examDemo,
	courseDemo,
	internationalDemo,
	employeeDemo,
	campusDemo,
	admissionDemo,
	boardingpassDemo,
}

func findDemo(slug string) (demo, bool) {
	for _, d := range demos {
		if d.slug == slug {
			return d, true
		}
	}

	return demo{}, false
}
