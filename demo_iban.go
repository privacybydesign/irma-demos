package main

type ibanStrings struct {
	Success string
	Name    string
	Agree   string
	Button  string
}

var ibanDemo = demo{
	slug:  "iban",
	label: localized[string]{EN: "IBAN form-filling", NL: "IBAN-formulier invullen"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to start direct debits.",
			Benefits: []string{
				"Trustworthy bank details, no typos",
				"No bank transfer needed to start a direct debit",
			},
			Data: cardData{
				Description: "The bank account card",
				Sources: []source{
					{Label: "the IBAN issuer", URL: "https://iban-issuer.yivi.app/en"},
				},
			},
			Sidenotes: "",
		},
		NL: page{
			Intro: "Handig om een automatische incasso op te zetten.",
			Benefits: []string{
				"Betrouwbare bankgegevens, zonder typefouten",
				"Geen overschrijving nodig om een automatische incasso op te zetten",
			},
			Data: cardData{
				Description: "De bankrekening-kaart",
				Sources: []source{
					{Label: "de IBAN-uitgever", URL: "https://iban-issuer.yivi.app/nl"},
				},
			},
			Sidenotes: "",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Fitz",
			URL:          "fitz.example/checkout",
			Title:        "Switch to direct debit",
			Action:       "Share your bank details",
		},
		NL: frame{
			Organisation: "Fitz",
			URL:          "fitz.example/afrekenen",
			Title:        "Wissel naar automatische incasso",
			Action:       "Deel je bankgegevens",
		},
	},
	strings: both(
		ibanStrings{
			Success: "Do you want to switch your €20/month gym subscription to direct debit from this bank account?",
			Name:    "Owner:",
			Agree:   "I agree with a monthly direct debit",
			Button:  "Save",
		},
		ibanStrings{
			Success: "Wil je je sportschool-abonnement van €20/maand wisselen naar een automatische incasso van deze bankrekening?",
			Name:    "T.n.v.:",
			Agree:   "Ik ga akkoord met een maandelijkse afschrijving",
			Button:  "Opslaan",
		},
	),
}
