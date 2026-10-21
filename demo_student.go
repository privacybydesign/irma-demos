package main

import "html/template"

type studentStrings struct {
	Software string
	Discount string
	Cart     string
	Error    template.HTML
}

var studentDemo = demo{
	slug:  "student",
	label: localized[string]{EN: "Access for students", NL: "Toegang voor studenten"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to give out educational discount.",
			Benefits: []string{
				"Only share student status, no personal data",
				"No manual checks of student cards",
				"Immediate certainty",
			},
			Data: cardData{
				Description: "The education and research card",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/en/surfconext/"},
				},
			},
			Sidenotes: "Some webshops or online services offer a student discount. Often, this requires uploading a picture of a student card (with photo and name) or verifying an email address from an educational institution. With Yivi, instead, no personal info is shared and no manual check is required. This could also work for other kinds of discounts, of course.",
		},
		NL: page{
			Intro: "Handig voor webwinkels en diensten die studentenkorting geven.",
			Benefits: []string{
				"Deel alleen dat je student bent, geen persoonlijke data",
				"Geen handmatige controles van studentenpassen",
				"Directe zekerheid",
			},
			Data: cardData{
				Description: "De ‘onderwijs en onderzoek’-kaart",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/en/surfconext/"},
				},
			},
			Sidenotes: "Sommige webshops of online diensten bieden studentenkorting aan. Vaak vereist dit het uploaden van een foto van de studenten pas (met pasfoto en naam) of het verifiëren van een emailadres van een onderwijsinstelling. Met Yivi, daarentegen, hoeven er geen persoonlijke gegevens gedeeld te worden en is er geen handmatige controle nodig. Dit zou natuurlijk ook voor andere kortingen kunnen werken.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "WebDot",
			URL:          "webdot.example/students",
			Title:        "Buy with student discount",
			Action:       "Prove you’re a student",
		},
		NL: frame{
			Organisation: "WebDot",
			URL:          "webdot.example/studenten",
			Title:        "Kopen met studentenkorting",
			Action:       "Toon aan dat je studeert",
		},
	},
	strings: both(
		studentStrings{
			Software: "ExpensiveSuite XY",
			Discount: "With student discount",
			Cart:     "Add to cart",
			Error:    "You did not prove that you are a student, but a <strong id=\"proof\"></strong>.",
		},
		studentStrings{
			Software: "ExpensiveSuite XY",
			Discount: "Met studentenkorting",
			Cart:     "Voeg toe aan winkelwagen",
			Error:    "Je hebt niet bewezen dat je een student bent, maar een <strong id=\"proof\"></strong>.",
		},
	),
}
