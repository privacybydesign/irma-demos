package main

import "html/template"

// ui holds the text that every description page shares.
type ui struct {
	Try           string
	WithYivi      string
	Benefits      string
	Cards         string
	Source        string
	Or            string
	NoInfo        string
	Reload        string
	Sidenotes     string
	More          string
	ForDevelopers string
	Request       string
	Copy          string
	WhatIsYivi    string
	Explanation   []string
	ReadMore      string
	GetYivi       string
	GettingYivi   string
	AppStores     string
	AppStore      string
	GooglePlay    string
	FDroid        string
}

var uiStrings = localized[ui]{
	EN: ui{
		Try:           "Try it out",
		WithYivi:      "with Yivi",
		Benefits:      "Benefits",
		Cards:         "Used wallet card(s)",
		Source:        " can come from: ",
		Or:            "or ",
		NoInfo:        "This is a demo, no information is stored",
		Reload:        "Reload",
		Sidenotes:     "Sidenotes",
		More:          "See it in use",
		ForDevelopers: "For developers",
		Request:       "Request",
		Copy:          "Copy",
		WhatIsYivi:    "What is Yivi?",
		Explanation: []string{
			"Yivi is an identity wallet. This is an app on your phone which allows you to securely share your personal information, online.",
			"For the user, it’s more privacy-friendly, since only specific information is shared. The receiver, on the other hand, can be sure the information is correct and true.",
		},
		ReadMore:    "Read more",
		GetYivi:     "Get Yivi",
		GettingYivi: "Getting Yivi",
		AppStores:   "You can download Yivi from the app store of your operating system.",
		AppStore:    "Download on the App Store",
		GooglePlay:  "Get it on Google Play",
		FDroid:      "Get it on F-Droid",
	},
	NL: ui{
		Try:           "Probeer het",
		WithYivi:      "met Yivi",
		Benefits:      "Voordelen",
		Cards:         "Gebruikte wallet-kaartjes",
		Source:        " kun je inladen van: ",
		Or:            "of ",
		NoInfo:        "Dit is een demo, we slaan geen informatie op",
		Reload:        "Herlaad",
		Sidenotes:     "Opmerkingen",
		More:          "In de praktijk",
		ForDevelopers: "Voor ontwikkelaars",
		Request:       "Request",
		Copy:          "Copy",
		WhatIsYivi:    "Wat is Yivi?",
		Explanation: []string{
			"Yivi is een identity wallet. Dit is een app op je telefoon waarmee je veilig, online jouw gegevens deelt.",
			"Voor de gebruiker is het privacyvriendelijker, omdat alleen specifieke informatie wordt gedeeld. De ontvanger kan er zeker van zijn dat de informatie klopt.",
		},
		ReadMore:    "Lees meer",
		GetYivi:     "Download Yivi",
		GettingYivi: "Yivi downloaden",
		AppStores:   "Je kunt Yivi downloaden via de app store van je telefoon.",
		AppStore:    "Download in de App Store",
		GooglePlay:  "Ontdek het op Google Play",
		FDroid:      "Verkrijg op F-Droid",
	},
}

type homeContent struct {
	Heading string
	Intro   string
	Body    template.HTML
}

var homeStrings = localized[homeContent]{
	EN: homeContent{
		Heading: "Demos",
		Intro:   "With Yivi you share only the information a website needs, in a way that the website can trust.",
		Body:    `Each demo shows one way of using it: disclosing information about yourself, or signing a statement. Pick the one that interests you from the list of demos and try it out yourself. You only need the <a href="https://yivi.app/#download">Yivi app</a> on your phone.`,
	},
	NL: homeContent{
		Heading: "Demo’s",
		Intro:   "Met Yivi deel je alleen de gegevens die een website nodig heeft, op een manier die de website kan vertrouwen.",
		Body:    `Elke demo laat één toepassing zien: gegevens over jezelf tonen, of een verklaring ondertekenen. Kies uit de lijst met demo’s degene die je interessant vindt en probeer het zelf. Je hebt alleen de <a href="https://yivi.app/#download">Yivi-app</a> op je telefoon nodig.`,
	},
}

type notFoundContent struct {
	Title       string
	Description template.HTML
}

var notFoundStrings = localized[notFoundContent]{
	EN: notFoundContent{
		Title:       "Page not found (404)",
		Description: `We couldn’t find this page. Try the menu or <a href="https://github.com/privacybydesign/irma-demos/issues" target="_blank">open an issue on Github</a>.`,
	},
	NL: notFoundContent{
		Title:       "Pagina niet gevonden (404)",
		Description: `We konden deze pagina niet vinden. Probeer het menu of <a href="https://github.com/privacybydesign/irma-demos/issues" target="_blank">maak een issue aan op Github</a>.`,
	},
}

// homeLabel is the label of the home page in the navigation, in both languages.
var homeLabel = localized[string]{EN: "Home", NL: "Home"}
