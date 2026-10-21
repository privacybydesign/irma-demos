package main

import "html/template"

type petitionStrings struct {
	Success template.HTML
}

var petitionDemo = demo{
	slug:  "petition",
	label: localized[string]{EN: "Petitions", NL: "Petities"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to collect signatures for a (local) initiative.",
			Benefits: []string{
				"Easy petition signing without email",
				"Limit to a certain neighbourhood",
				"No invalid signatures",
			},
			Data: cardData{
				Description: "The personal data card",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "This demo combines <a href='../chained'>chained sessions</a> and <a href='../signature'>signatures</a>. The demo doesn’t perform any checks, but shows what it would look like if first a user proves they live in the area where petition may be signed before signing. This way, signatures can be validated before storing, instead of after collecting all signatures.",
		},
		NL: page{
			Intro: "Handig om handtekeningen te verzamelen voor een (lokaal) initiatief.",
			Benefits: []string{
				"Makkelijk een petitie ondertekenen zonder email",
				"Laat alleen mensen uit de buurt tekenen",
				"Geen ongeldige handtekeningen",
			},
			Data: cardData{
				Description: "Het persoonsgegevenskaartje",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Deze demo combineert <a href='../chained'>chained sessions</a> en <a href='../signature'>handtekeningen</a>. De demo checkt niks, maar toont hoe het eruit zou zien als een gebruiker eerst bewijst dat ze in de gemeente wonen waar de petitie ondertekend mag worden, voor het ondertekenen. Op deze manier kan een handtekening worden gevalideerd voor het opslaan, in plaats van wanneer alle handtekeningen zijn verzameld.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "ChangeIt",
			URL:          "changeit.example/petitions",
			Title:        "Sign the petition",
			Action:       "Share your place of residence and sign",
		},
		NL: frame{
			Organisation: "VeranderT",
			URL:          "verandert.example/petities",
			Title:        "Onderteken de petitie",
			Action:       "Deel je woonplaats en onderteken",
		},
	},
	strings: both(
		petitionStrings{
			Success: "Thanks for signing our petition! You could only sign this petition because you live in <strong id=\"city\"></strong>.",
		},
		petitionStrings{
			Success: "Bedankt voor het ondertekenen van onze petitie! Je kon deze petitie alleen wonen omdat je in <strong id=\"city\"></strong> woont.",
		},
	),
}
