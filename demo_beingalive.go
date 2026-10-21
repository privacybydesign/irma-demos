package main

import "html/template"

type beingaliveStrings struct {
	DataAge template.HTML
	Success template.HTML
	Error   template.HTML
}

var beingaliveDemo = demo{
	slug:  "beingalive",
	label: localized[string]{EN: "Prove that you are alive", NL: "Bewijs dat je leeft"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to prove you are alive for life annuities or pensions.",
			Benefits: []string{
				"Saves you a trip to the city hall",
				"No physical forms which need to be sent by post",
			},
			Data: cardData{
				Description: "The personal data card",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Pension funds or governments giving out annuities sometimes require a certificate of life. Traditionally, this requires getting a signed form at a counter. By sharing identifying details which were recently loaded into Yivi, the receiving party can be sure the person is alive. After all, the resident registration will not allow the card to be issued if the person has passed.",
		},
		NL: page{
			Intro: "Handig om te bewijzen dat je leeft voor pensioen- of AOW-betalingen.",
			Benefits: []string{
				"Bespaart je een trip naar het gemeentehuis",
				"Geen fysieke formulieren die per post verstuurd moeten worden",
			},
			Data: cardData{
				Description: "Het persoonsgegevenskaartje",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Pensioenfondsen of overheden die ouderdomspensioen betalen vereisen soms een bewijs van leven (attestatie de vita). In het verleden betekende dit dat je een getekend formulier bij een balie moest halen. Door het delen van identificerende gegevens die recent in Yivi zijn geladen, kan een ontvangende partij er zeker van zijn dat de persoon leeft. De BRP geeft namelijk geen persoonsgegevens-kaart meer uit wanneer de persoon is overleden.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "OnePensioen",
			URL:          "onepensioen.example/my-pension",
			Title:        "Prove you’re alive to continue your payout",
			Action:       "Share your proof of life",
		},
		NL: frame{
			Organisation: "EenPensioen",
			URL:          "eenpensioen.example/mijn-pensioen",
			Title:        "Bewijs dat je leeft om je uitbetaling voor te zetten",
			Action:       "Deel bewijs dat je leeft",
		},
	},
	strings: both(
		beingaliveStrings{
			DataAge: "The data you have shared is <strong id=\"dataAge\"></strong> days old.",
			Success: "✅ We will continue your pension payout, because you, <strong id=\"initials\"></strong> <strong id=\"familyName\"></strong> (<strong id=\"dateOfBirth\"></strong>), have proven you are alive.",
			Error:   "❌ To prove you are alive, your data should be no more than <strong id=\"limit\"></strong> days old. Please <a href=\"https://yivi.nijmegen.nl/login\">refresh your citizen registry data</a> and try again.",
		},
		beingaliveStrings{
			DataAge: "De data die je hebt gedeeld is <strong id=\"dataAge\"></strong> dagen oud.",
			Success: "✅ We zullen doorgaan met je pensioen uitbetalen, omdat jij, <strong id=\"initials\"></strong> <strong id=\"familyName\"></strong> (<strong id=\"dateOfBirth\"></strong>), hebt bewezen dat je nog leeft.",
			Error:   "❌ Om te bewijzen dat je leeft, mag je data niet ouder dan <strong id=\"limit\"></strong> dagen oud zijn. <a href=\"https://yivi.nijmegen.nl/login\">Herlaad je persoonsgegevens</a> en probeer het opnieuw.",
		},
	),
}
