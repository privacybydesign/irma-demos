package main

import "html/template"

type admissionStrings struct {
	ChecksTitle   string
	Qualification string
	Level         string
	Institution   string
	Awarded       string
	Holder        string
	CheckDiploma  template.HTML
	CheckLevel    template.HTML
	LevelKnown    template.HTML
	LevelUnknown  string
	Success       template.HTML
	Error         string
}

var admissionDemo = demo{
	slug:  "admission",
	label: localized[string]{EN: "Master’s admission with a diploma", NL: "Toelating master met een diploma"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for admissions offices that must verify prior education before admitting a student.",
			Benefits: []string{
				"The diploma comes from the DUO diploma register and is bound to the holder’s identity",
				"Level of the prior education checked automatically on the NLQF level",
				"The applicant shares one diploma, not a whole transcript or a PDF",
			},
			Data: cardData{
				Description: "The diploma card",
				Sources: []source{
					{Label: "the DUO diploma extract (via diploma.staging.yivi.app)", URL: "https://diploma.staging.yivi.app/en"},
				},
			},
			Sidenotes: "Admission to a master’s programme requires a bachelor’s degree, and universities receive thousands of applications with uploaded diploma scans that have to be checked by hand or verified with DUO. With a diploma in the wallet the applicant shares the diploma card: the kind of document, the qualification, its NLQF level, the institution, the date awarded and the holder’s name. The card was created from the digitally signed extract of “Mijn diploma’s” (DUO) and bound to the holder’s identity when it was issued, so the university knows the diploma is genuine and belongs to this person without seeing a PDF. The page then only checks whether the NLQF level (6 for a bachelor’s) gives access to a master’s programme. The same mechanism applies to micro-credentials and edubadges for individual courses, and to transcripts of records, once those are available as wallet cards. This demo uses the staging scheme; the diploma card is issued at diploma.staging.yivi.app.",
		},
		NL: page{
			Intro: "Handig voor toelatingsbureaus die de vooropleiding moeten controleren voordat een student wordt toegelaten.",
			Benefits: []string{
				"Het diploma komt uit het diplomaregister van DUO en is gekoppeld aan de identiteit van de houder",
				"Niveau van de vooropleiding automatisch gecontroleerd op het NLQF-niveau",
				"De aanmelder deelt één diploma, niet een hele cijferlijst of een PDF",
			},
			Data: cardData{
				Description: "Het diplomakaartje",
				Sources: []source{
					{Label: "het DUO-diploma-uittreksel (via diploma.staging.yivi.app)", URL: "https://diploma.staging.yivi.app/nl"},
				},
			},
			Sidenotes: "Toelating tot een master vereist een bachelordiploma, en universiteiten krijgen duizenden aanmeldingen met geüploade diplomascans die met de hand of via DUO gecontroleerd moeten worden. Met een diploma in de wallet deelt de aanmelder het diplomakaartje: het soort document, de opleiding, het NLQF-niveau, de instelling, de datum waarop het is behaald en de naam van de houder. Het kaartje is gemaakt uit het digitaal ondertekende uittreksel van “Mijn diploma’s” (DUO) en bij uitgifte gekoppeld aan de identiteit van de houder, zodat de universiteit weet dat het diploma echt is en van deze persoon is zonder een PDF te zien. De pagina controleert daarna alleen of het NLQF-niveau (6 voor een bachelor) toegang geeft tot een masteropleiding. Hetzelfde mechanisme werkt voor microcredentials en edubadges voor losse vakken, en voor cijferlijsten (transcripts of records), zodra die als walletkaartjes beschikbaar zijn. Deze demo gebruikt het staging-schema; het diplomakaartje wordt uitgegeven op diploma.staging.yivi.app.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University · Admissions",
			URL:          "waalstad-university.example/masters/artificial-intelligence/apply",
			Title:        "Apply for the Master’s in Artificial Intelligence",
			Action:       "Share your diploma",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad · Toelating",
			URL:          "universiteit-waalstad.example/masters/kunstmatige-intelligentie/aanmelden",
			Title:        "Meld je aan voor de master Kunstmatige Intelligentie",
			Action:       "Deel je diploma",
		},
	},
	strings: both(
		admissionStrings{
			ChecksTitle:   "Prior education",
			Qualification: "Qualification",
			Level:         "NLQF level",
			Institution:   "Awarded by",
			Awarded:       "Date awarded",
			Holder:        "Diploma holder",
			CheckDiploma:  "The <strong id=\"documenttype\"></strong> comes from the DUO diploma register and is bound to the holder’s identity",
			CheckLevel:    "<span id=\"level-text\"></span> gives access to a master’s programme (NLQF 6 or higher)",
			LevelKnown:    "NLQF level <strong>%s</strong>",
			LevelUnknown:  "The qualification",
			Success:       "✅ Your prior education is verified, <strong id=\"name\"></strong>. Your application is complete; the admissions committee will let you know within four weeks.",
			Error:         "ℹ️ This diploma does not automatically give access. Your application has been forwarded to the admissions committee for an individual assessment.",
		},
		admissionStrings{
			ChecksTitle:   "Vooropleiding",
			Qualification: "Opleiding",
			Level:         "NLQF-niveau",
			Institution:   "Behaald bij",
			Awarded:       "Datum behaald",
			Holder:        "Op naam van",
			CheckDiploma:  "Het <strong id=\"documenttype\"></strong> komt uit het diplomaregister van DUO en is gekoppeld aan de identiteit van de houder",
			CheckLevel:    "<span id=\"level-text\"></span> geeft toegang tot een masteropleiding (NLQF 6 of hoger)",
			LevelKnown:    "NLQF-niveau <strong>%s</strong>",
			LevelUnknown:  "De opleiding",
			Success:       "✅ Je vooropleiding is gecontroleerd, <strong id=\"name\"></strong>. Je aanmelding is compleet; de toelatingscommissie laat binnen vier weken van zich horen.",
			Error:         "ℹ️ Dit diploma geeft niet automatisch toegang. Je aanmelding is doorgestuurd naar de toelatingscommissie voor een individuele beoordeling.",
		},
	),
}
