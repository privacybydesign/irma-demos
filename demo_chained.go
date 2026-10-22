package main

import "html/template"

type chainedStrings struct {
	Success template.HTML
}

var chainedDemo = demo{
	slug:  "chained",
	label: localized[string]{EN: "Chained sessions", NL: "Chained sessions"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to give out personal, conditional cards",
			Benefits: []string{
				"Issue a card based on disclosed data",
				"The user only opens Yivi once",
			},
			Data: cardData{
				Description: "Works with any card, but this demo uses a name for the member card;",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: brpLoginURL},
					{Label: "passport"},
					{Label: "driver’s license"},
					{Label: "identity card"},
					{Label: "LinkedIn", URL: "https://saml-issuer.yivi.app/en/linkedin/"},
				},
			},
			More: &moreDemos{
				Description: "The YiviTube Premium membership card can be used in this YiviTube demo:",
				Links: []link{
					{Label: "YiviTube", URL: "https://yivitube.yivi.app/"},
				},
			},
			Sidenotes: "This demo shows chained sessions: multiple sessions (so disclosure of data or issuance of a new card) happen after the user scans the Yivi QR code (or presses the button) only once. The data from earlier sessions (here, the disclosed name) can be used in later sessions (here, the membership card).",
		},
		NL: page{
			Intro: "Handig om persoonlijke, voorwaardelijke kaarten uit te geven",
			Benefits: []string{
				"Geef een kaart uit op basis van ontvangen data",
				"De gebruiker hoeft Yivi maar één keer te openen",
			},
			Data: cardData{
				Description: "Works with any card, but this demo uses a name for the member card;",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: brpLoginURL},
					{Label: "paspoort"},
					{Label: "rijbewijs"},
					{Label: "ID-kaart"},
					{Label: "LinkedIn", URL: "https://saml-issuer.yivi.app/nl/linkedin/"},
				},
			},
			More: &moreDemos{
				Description: "De YiviTube Premium lidmaatschapskaart kan worden gebruikt in deze YiviTube demo:",
				Links: []link{
					{Label: "YiviTube", URL: "https://yivitube.yivi.app/"},
				},
			},
			Sidenotes: "Deze demo laat ‘chained sessions’ zien: meerdere sessies (dus het ontvangen van data of uitgeven van een nieuwe kaart) gebeuren nadat de gebruiker maar één keer de Yivi QR-code scant (of op de knop drukt). De data van eerdere sessies (hier is dat de naam) kan gebruikt worden in latere sessies (hier is dat het lidmaatschap).",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "YiviTube",
			URL:          "yivitube.example/upload",
			Title:        "Become YiviTube Premium member",
			Action:       "Share your name and get a membership",
		},
		NL: frame{
			Organisation: "YiviTube",
			URL:          "yivitube.example/upload",
			Title:        "Word YiviTube Premiumlid",
			Action:       "Deel je naam en ontvang een lidmaatschap",
		},
	},
	strings: both(
		chainedStrings{
			Success: "<strong>You’re now a YiviTube Premium member!</strong> You can use the membership card on <a href=\"https://yivitube.yivi.app\">YiviTube</a>.",
		},
		chainedStrings{
			Success: "<strong>Je bent nu een YiviTube Premiumlid!</strong> Je kunt de lidmaatschapskaart gebruiken op <a href=\"https://yivitube.yivi.app\">YiviTube</a>.",
		},
	),
}
