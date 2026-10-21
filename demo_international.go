package main

import "html/template"

type internationalStrings struct {
	ChecksTitle       string
	CheckDocument     template.HTML
	CheckMunicipality template.HTML
	CheckEu           template.HTML
	EuYes             string
	EuNo              string
	DocumentPassport  string
	DocumentIdcard    string
	Success           template.HTML
	Error             string
}

var internationalDemo = demo{
	slug:  "international",
	label: localized[string]{EN: "International student intake", NL: "Intake internationale student"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for universities and municipalities that register international students together.",
			Benefits: []string{
				"One wallet, two organisations: the passport for the university and the address from the municipality",
				"Immediately clear whether a residence permit is needed",
				"No passport copies passed between the university and the municipality",
			},
			Data: cardData{
				Description: "A travel document card and the address card",
				Sources: []source{
					{Label: "passport"},
					{Label: "identity card"},
					{Label: "the municipality of Nijmegen", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "When international students arrive, they have to register with both the university and the municipality, and both need to see the same passport. The municipality of Nijmegen already issues the personal data and address cards to residents through Yivi. In this demo the university builds on that: the student shares the passport or identity card from the wallet together with the municipal address card. The university sees that the travel document is still valid, that the student is registered at an address in the city and whether the student is an EU citizen. That last answer decides the next step: EU citizens are done, for others the university starts the residence permit application with the IND. The student never hands over a passport copy.",
		},
		NL: page{
			Intro: "Handig voor universiteiten en gemeenten die samen internationale studenten inschrijven.",
			Benefits: []string{
				"Eén wallet, twee organisaties: het paspoort voor de universiteit en het adres van de gemeente",
				"Direct duidelijk of een verblijfsvergunning nodig is",
				"Geen paspoortkopieën heen en weer tussen universiteit en gemeente",
			},
			Data: cardData{
				Description: "Een reisdocumentkaartje en het adreskaartje",
				Sources: []source{
					{Label: "paspoort"},
					{Label: "ID-kaart"},
					{Label: "de gemeente Nijmegen", URL: "https://yivi.nijmegen.nl/login"},
				},
			},
			Sidenotes: "Als internationale studenten aankomen, moeten ze zich zowel bij de universiteit als bij de gemeente inschrijven, en beide willen hetzelfde paspoort zien. De gemeente Nijmegen geeft persoonsgegevens en adreskaartjes al via Yivi uit aan inwoners. In deze demo bouwt de universiteit daarop voort: de student deelt het paspoort of de ID-kaart uit de wallet samen met het adreskaartje van de gemeente. De universiteit ziet dat het reisdocument nog geldig is, dat de student op een adres in de stad staat ingeschreven en of de student EU-burger is. Dat laatste bepaalt de volgende stap: EU-burgers zijn klaar, voor anderen start de universiteit de aanvraag van een verblijfsvergunning bij de IND. De student geeft nooit een paspoortkopie af.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University · International Office",
			URL:          "waalstad-university.example/international/arrival",
			Title:        "Complete your arrival registration",
			Action:       "Share your travel document and address",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad · International Office",
			URL:          "universiteit-waalstad.example/international/aankomst",
			Title:        "Rond je aankomstregistratie af",
			Action:       "Deel je reisdocument en adres",
		},
	},
	strings: both(
		internationalStrings{
			ChecksTitle:       "Arrival checklist",
			CheckDocument:     "Your <strong id=\"document\"></strong> is valid until <strong id=\"expiry\"></strong>",
			CheckMunicipality: "You are registered with the municipality at <strong id=\"address\"></strong>",
			CheckEu:           "Nationality <strong id=\"nationality\"></strong>: <span id=\"eu-text\"></span>",
			EuYes:             "EU/EEA citizen, no residence permit needed",
			EuNo:              "non-EU, we will apply for your residence permit with the IND",
			DocumentPassport:  "passport",
			DocumentIdcard:    "identity card",
			Success:           "✅ Welcome to Waalstad, <strong id=\"name\"></strong>! Your arrival is registered. Your student account and campus access will be activated within one working day.",
			Error:             "❌ We can’t complete your arrival registration automatically. Please book an appointment with the International Office and bring your travel document.",
		},
		internationalStrings{
			ChecksTitle:       "Aankomstchecklist",
			CheckDocument:     "Je <strong id=\"document\"></strong> is geldig tot <strong id=\"expiry\"></strong>",
			CheckMunicipality: "Je staat bij de gemeente ingeschreven op <strong id=\"address\"></strong>",
			CheckEu:           "Nationaliteit <strong id=\"nationality\"></strong>: <span id=\"eu-text\"></span>",
			EuYes:             "EU/EER-burger, geen verblijfsvergunning nodig",
			EuNo:              "niet-EU, wij vragen je verblijfsvergunning aan bij de IND",
			DocumentPassport:  "paspoort",
			DocumentIdcard:    "identiteitskaart",
			Success:           "✅ Welkom in Waalstad, <strong id=\"name\"></strong>! Je aankomst is geregistreerd. Je studentaccount en campustoegang worden binnen één werkdag geactiveerd.",
			Error:             "❌ We kunnen je aankomstregistratie niet automatisch afronden. Maak een afspraak met het International Office en neem je reisdocument mee.",
		},
	),
}
