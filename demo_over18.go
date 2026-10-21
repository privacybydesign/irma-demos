package main

type over18Strings struct {
	Software string
	Cart     string
	Error    string
}

var over18Demo = demo{
	slug:  "18plus",
	label: localized[string]{EN: "Prove 18+", NL: "18+ bewijzen"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for webshops or video sites that need to make sure the visitor is older than 18.",
			Benefits: []string{
				"Only share the fact that you are 18+",
				"No personal data which could be leaked",
				"Also works for 12+, 16+, 21+ and 65+",
			},
			Data: cardData{
				Description: "The personal data card",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: "https://yivi.nijmegen.nl/login"},
					{Label: "passport"},
					{Label: "driver’s license"},
					{Label: "identity card"},
				},
			},
			More: &moreDemos{
				Description: "Two demos put this age check to work in a setting that looks like a real site:",
				Links: []link{
					{Label: "Angry Games", URL: "https://angrygames.yivi.app"},
					{Label: "YiviTube", URL: "https://yivitube.yivi.app"},
				},
			},
			Sidenotes: "Webshops, movie platforms, or gambling sites have a legal obligation to perform age verification when offering violent or possibly offensive products. Currently, many of these sites do not have proper age checks because there is no user-friendly (and cheap) technology available. Yivi fills this gap.",
		},
		NL: page{
			Intro: "Handig voor webshops of videoplatforms die zeker moeten weten dat een bezoeker ouder is dan 18.",
			Benefits: []string{
				"Deel alleen dat je 18+ bent",
				"Geen persoonlijke data die zou kunnen lekken",
				"Werkt ook voor 12+, 16+, 21+ en 65+",
			},
			Data: cardData{
				Description: "Het persoonsgegevenskaartje",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: "https://yivi.nijmegen.nl/login"},
					{Label: "paspoort"},
					{Label: "rijbewijs"},
					{Label: "ID-kaart"},
				},
			},
			More: &moreDemos{
				Description: "In twee demo’s wordt deze leeftijdscontrole gebruikt in een omgeving die op een echte site lijkt:",
				Links: []link{
					{Label: "Angry Games", URL: "https://angrygames.yivi.app"},
					{Label: "YiviTube", URL: "https://yivitube.yivi.app"},
				},
			},
			Sidenotes: "Webshops, filmplatforms, of gokwebsites hebben een wettelijke verplichting om leeftijd te controleren bij het aanbieden van geweldadige of mogelijk aanstootgevende producten. Tot nu toe ziet de overheid meestal door de vingers dat webwinkels geen echte leeftijdscontrole uitvoeren, omdat er geen gebruiksvriendelijke (en goedkope) technologie beschikbaar zou zijn. Yivi kan dit oplossen.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Gamiverse",
			URL:          "gamiverse.example/games/crimson-harbour-vi",
			Title:        "Buy Crimson Harbour VI (18+)",
			Action:       "Prove you’re older than 18",
		},
		NL: frame{
			Organisation: "Gamiverse",
			URL:          "gamiverse.example/games/crimson-harbour-vi",
			Title:        "Koop Crimson Harbour VI (18+)",
			Action:       "Toon aan dat je ouder dan 18 bent",
		},
	},
	strings: both(
		over18Strings{
			Software: "Crimson Harbour VI",
			Cart:     "Add to cart",
			Error:    "You seem to be younger than 18, so you can’t buy this game. Sorry!",
		},
		over18Strings{
			Software: "Crimson Harbour VI",
			Cart:     "Voeg toe aan winkelwagen",
			Error:    "Je lijkt jonger te zijn dan 18, dus je mag dit spel niet kopen. Sorry!",
		},
	),
}
