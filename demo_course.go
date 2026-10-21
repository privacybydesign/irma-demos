package main

import "html/template"

type courseStrings struct {
	FormTitle      string
	FirstNames     string
	FamilyName     string
	DateOfBirth    string
	Nationality    string
	Email          string
	Source         template.HTML
	SourcePassport string
	SourceIdcard   string
	SourceBrp      string
	Submit         string
}

var courseDemo = demo{
	slug:  "course",
	label: localized[string]{EN: "Course enrolment with passport data", NL: "Cursusinschrijving met paspoortgegevens"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for enrolling course participants whose personal data must match their passport, without DigiD.",
			Benefits: []string{
				"Names, date of birth and nationality exactly as on the passport or in the BRP",
				"No typing errors and no copies of passports by email",
				"Works for participants who cannot or do not want to log in with DigiD",
			},
			Data: cardData{
				Description: "An identity card and the email card",
				Sources: []source{
					{Label: "passport"},
					{Label: "identity card"},
					{Label: "the Dutch resident registration (BRP)", URL: brpLoginURL},
					{Label: "your email address", URL: "https://email-issuer.yivi.app/en"},
				},
			},
			Sidenotes: "Universities offer courses to professionals who are not enrolled as regular students. These participants sign up with a name and an email address, but the moment they formally enrol the university must register their personal data exactly as they appear on their passport. Without DigiD that means asking for a passport copy and retyping it. In this demo the participant shares an identity card from the wallet (passport, identity card or the BRP card issued by the municipality) together with the email card. The enrolment form is filled in with the exact registered values and shows which document they came from. A driving licence is deliberately not accepted here: it does not carry a nationality.",
		},
		NL: page{
			Intro: "Handig om cursisten in te schrijven van wie de persoonsgegevens moeten kloppen met het paspoort, zonder DigiD.",
			Benefits: []string{
				"Namen, geboortedatum en nationaliteit precies zoals in het paspoort of de BRP",
				"Geen typefouten en geen paspoortkopieën per e-mail",
				"Werkt ook voor cursisten die niet met DigiD kunnen of willen inloggen",
			},
			Data: cardData{
				Description: "Een identiteitskaartje en het e-mailkaartje",
				Sources: []source{
					{Label: "paspoort"},
					{Label: "ID-kaart"},
					{Label: "de basisregistratie (BRP)", URL: brpLoginURL},
					{Label: "je e-mailadres", URL: "https://email-issuer.yivi.app/nl"},
				},
			},
			Sidenotes: "Universiteiten bieden onderwijs aan professionals die niet als reguliere student staan ingeschreven. Deze cursisten melden zich aan met een naam en een e-mailadres, maar op het moment dat ze zich formeel inschrijven moet de universiteit hun persoonsgegevens registreren zoals ze in het paspoort staan. Zonder DigiD betekent dat een paspoortkopie opvragen en overtypen. In deze demo deelt de cursist een identiteitskaartje uit de wallet (paspoort, ID-kaart of het BRP-kaartje van de gemeente) samen met het e-mailkaartje. Het inschrijfformulier wordt gevuld met de exacte geregistreerde waarden en laat zien uit welk document ze komen. Een rijbewijs wordt hier bewust niet geaccepteerd: daar staat geen nationaliteit op.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University · Professional Education",
			URL:          "waalstad-university.example/professionals/enrol",
			Title:        "Enrol in Leadership in Healthcare",
			Action:       "Fill in with your identity and email",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad · Onderwijs voor Professionals",
			URL:          "universiteit-waalstad.example/professionals/inschrijven",
			Title:        "Schrijf je in voor Leiderschap in de Zorg",
			Action:       "Vul in met je identiteit en e-mail",
		},
	},
	strings: both(
		courseStrings{
			FormTitle:      "Your enrolment",
			FirstNames:     "First names",
			FamilyName:     "Family name",
			DateOfBirth:    "Date of birth",
			Nationality:    "Nationality",
			Email:          "Email address",
			Source:         "Personal data taken from your <strong id=\"source\"></strong>, exactly as registered there.",
			SourcePassport: "passport",
			SourceIdcard:   "identity card",
			SourceBrp:      "municipal registration (BRP)",
			Submit:         "Complete enrolment",
		},
		courseStrings{
			FormTitle:      "Je inschrijving",
			FirstNames:     "Voornamen",
			FamilyName:     "Achternaam",
			DateOfBirth:    "Geboortedatum",
			Nationality:    "Nationaliteit",
			Email:          "E-mailadres",
			Source:         "Persoonsgegevens overgenomen van je <strong id=\"source\"></strong>, precies zoals daar geregistreerd.",
			SourcePassport: "paspoort",
			SourceIdcard:   "identiteitskaart",
			SourceBrp:      "inschrijving bij de gemeente (BRP)",
			Submit:         "Inschrijving afronden",
		},
	),
}
