package main

type addressStrings struct {
	Year string
}

var addressDemo = demo{
	slug:  "address",
	label: localized[string]{EN: "Address form-filling", NL: "Adresformulier invullen"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for quickly filling forms or getting access to address based info.",
			Benefits: []string{
				"Share the address as it appears in the citizen registry",
				"Full address or just the postal code/city",
			},
			Data: cardData{
				Description: "The personal data card",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Addresses shared this way are reliable. You can’t make a mistake, and the receiver can be sure you are registered there. This could replace the need for some organisations to send a postal card with a verification code, for example. It also works for other information, like name, email address, phone number etc.",
		},
		NL: page{
			Intro: "Handig voor het snel invullen van formulieren of het toegang krijgen tot adres-specifieke informatie.",
			Benefits: []string{
				"Deel het adres zoals het in de basisregistratie staat",
				"Volledig adres of alleen de stad/postcode",
			},
			Data: cardData{
				Description: "Het persoonsgegevenskaartje",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Adressen die zo gedeeld worden zijn betrouwbaar. Je kan geen fouten maken en de ontvanger kan zeker zijn dat jij daar staat ingeschreven. Dit zou ook kunnen werken voor organisaties die nu een postkaart sturen met een verificatiecode, bijvoorbeeld. Dit werkt ook voor andere informatie, zoals namen, emailadressen, telefoonummers, etc.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "YourEnergy",
			URL:          "yourenergy.example/sign-up",
			Title:        "View your electricity use",
			Action:       "Share your address",
		},
		NL: frame{
			Organisation: "JouwEnergie",
			URL:          "jouwenergie.example/aanmelden",
			Title:        "Bekijk je stroomverbruik",
			Action:       "Deel je adres",
		},
	},
	strings: both(
		addressStrings{
			Year: "This year at",
		},
		addressStrings{
			Year: "Dit jaar op",
		},
	),
}
