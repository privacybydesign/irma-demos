package main

var boardingpassDemo = demo{
	slug:  "boardingpass",
	label: localized[string]{EN: "Boarding pass in your wallet", NL: "Instapkaart in je wallet"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for organisations that hand out a personalised wallet card as the result of a session: here a passport becomes a boarding pass.",
			Benefits: []string{
				"Needs the passport card, loaded by scanning your passport with NFC, a heavier step than the other demos here",
				"The name on the boarding pass comes straight from the passport, so it can’t be mistyped and always matches your travel document",
				"You walk away with a new card in your wallet, not just a disclosure",
			},
			Data: cardData{
				Description: "The passport card",
				Sources: []source{
					{Label: "passport"},
				},
			},
			External: &externalDemo{
				Description: "This demo is hosted on its own site, not here. You need the passport card in your wallet before you start; you load it by scanning your passport with NFC.",
				URL:         "https://boarding-pass.yivi.app",
				Action:      "Open the boarding pass demo",
			},
			Sidenotes: "This demo shows a chained session: after disclosing your first and last name from the passport, a second session issues irma-demo.demo-airline.boardingpass directly into your wallet, filled with that name plus fixed demo flight data (flight Y256, AMS to MXP, seat 15B, gate 12). The demo itself runs on its own site, separate from this one; nothing you disclose there is shared with this page.",
		},
		NL: page{
			Intro: "Handig voor organisaties die na een sessie een persoonlijk wallet-kaartje uitgeven: hier wordt een paspoort een instapkaart.",
			Benefits: []string{
				"Vereist het paspoortkaartje, dat je inlaadt door je paspoort te scannen met NFC, een zwaardere stap dan de andere demo’s hier",
				"De naam op de instapkaart komt direct van het paspoort, dus die kan niet verkeerd getypt worden en komt altijd overeen met je reisdocument",
				"Je houdt er een nieuw kaartje in je wallet aan over, niet alleen een gedeeld gegeven",
			},
			Data: cardData{
				Description: "Het paspoortkaartje",
				Sources: []source{
					{Label: "paspoort"},
				},
			},
			External: &externalDemo{
				Description: "Deze demo staat op een eigen site, niet hier. Je hebt het paspoortkaartje in je wallet nodig voor je begint; dat laad je in door je paspoort te scannen met NFC.",
				URL:         "https://boarding-pass.yivi.app",
				Action:      "Open de instapkaart-demo",
			},
			Sidenotes: "Deze demo laat een chained session zien: na het delen van je voor- en achternaam uit het paspoort, geeft een tweede sessie irma-demo.demo-airline.boardingpass rechtstreeks uit in je wallet, gevuld met die naam plus vaste demo-vluchtgegevens (vlucht Y256, AMS naar MXP, stoel 15B, gate 12). De demo zelf draait op een eigen site, los van deze; wat je daar deelt, wordt niet gedeeld met deze pagina.",
		},
	},
}
