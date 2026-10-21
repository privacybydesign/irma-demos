package main

import "html/template"

type employeeStrings struct {
	ChecksTitle      string
	CheckDocument    template.HTML
	CheckIban        template.HTML
	FormTitle        string
	FirstNames       string
	FamilyName       string
	DateOfBirth      string
	Nationality      string
	Address          string
	Iban             string
	DocumentPassport string
	DocumentIdcard   string
	Success          template.HTML
	Error            string
}

var employeeDemo = demo{
	slug:  "employee",
	label: localized[string]{EN: "New employee onboarding", NL: "Nieuwe medewerker registreren"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for HR departments that must verify the identity of new employees and record their details.",
			Benefits: []string{
				"Identity verified against the chip of the passport, not a photocopy",
				"Personnel file filled in without typing errors: names, address, IBAN",
				"Checks that the document is valid and the salary account belongs to the employee",
			},
			Data: cardData{
				Description: "A travel document card, an address card and the IBAN card",
				Sources: []source{
					{Label: "passport"},
					{Label: "identity card"},
					{Label: "the Dutch resident registration (BRP)", URL: brpLoginURL},
					{Label: "your bank", URL: "https://iban-issuer.yivi.app/en"},
				},
			},
			Sidenotes: "Employers are obliged to verify the identity of a new employee against an original identity document before the first working day. In practice, new employees email a copy of their passport to HR, who retype the details into the personnel system and keep the copy. In this demo the new employee shares the passport or identity card from the wallet (read from the document’s chip when it was added), together with the home address and the IBAN card issued by the bank. The university sees that the document is valid, checks that the salary account is in the employee’s name and fills in the personnel file. Because the wallet cards are signed by their issuers, no copy of the document needs to be stored.",
		},
		NL: page{
			Intro: "Handig voor HR-afdelingen die de identiteit van nieuwe medewerkers moeten vaststellen en hun gegevens vastleggen.",
			Benefits: []string{
				"Identiteit gecontroleerd op basis van de chip in het paspoort, niet een fotokopie",
				"Personeelsdossier gevuld zonder typefouten: namen, adres, IBAN",
				"Controleert dat het document geldig is en de salarisrekening van de medewerker is",
			},
			Data: cardData{
				Description: "Een reisdocumentkaartje, een adreskaartje en het IBAN-kaartje",
				Sources: []source{
					{Label: "paspoort"},
					{Label: "ID-kaart"},
					{Label: "de basisregistratie (BRP)", URL: brpLoginURL},
					{Label: "je bank", URL: "https://iban-issuer.yivi.app/nl"},
				},
			},
			Sidenotes: "Werkgevers zijn verplicht de identiteit van een nieuwe medewerker vóór de eerste werkdag vast te stellen aan de hand van een origineel identiteitsbewijs. In de praktijk mailen nieuwe medewerkers een kopie van hun paspoort naar HR, die de gegevens overtypt in het personeelssysteem en de kopie bewaart. In deze demo deelt de nieuwe medewerker het paspoort of de ID-kaart uit de wallet (bij het toevoegen uitgelezen uit de chip van het document), samen met het woonadres en het IBAN-kaartje van de bank. De universiteit ziet dat het document geldig is, controleert dat de salarisrekening op naam van de medewerker staat en vult het personeelsdossier. Omdat de kaartjes in de wallet door de uitgevers zijn ondertekend, hoeft er geen kopie van het document te worden bewaard.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University · HR",
			URL:          "waalstad-university.example/hr/onboarding",
			Title:        "Welcome aboard: complete your personnel file",
			Action:       "Share your identity, address and IBAN",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad · HR",
			URL:          "universiteit-waalstad.example/hr/indiensttreding",
			Title:        "Welkom: vul je personeelsdossier aan",
			Action:       "Deel je identiteit, adres en IBAN",
		},
	},
	strings: both(
		employeeStrings{
			ChecksTitle:      "Identity verification",
			CheckDocument:    "<strong id=\"document\"></strong> <strong id=\"documentnumber\"></strong> is valid until <strong id=\"expiry\"></strong>",
			CheckIban:        "The salary account is held by <strong id=\"accountholder\"></strong>",
			FormTitle:        "Personnel file",
			FirstNames:       "First names",
			FamilyName:       "Family name",
			DateOfBirth:      "Date of birth",
			Nationality:      "Nationality",
			Address:          "Home address",
			Iban:             "Salary account (IBAN)",
			DocumentPassport: "Passport",
			DocumentIdcard:   "Identity card",
			Success:          "✅ Thanks, <strong id=\"name\"></strong>. Your identity has been verified and your personnel file is complete. No copy of your identity document has been stored.",
			Error:            "❌ We could not verify your details automatically. HR will contact you to complete your file in person.",
		},
		employeeStrings{
			ChecksTitle:      "Identiteitscontrole",
			CheckDocument:    "<strong id=\"document\"></strong> <strong id=\"documentnumber\"></strong> is geldig tot <strong id=\"expiry\"></strong>",
			CheckIban:        "De salarisrekening staat op naam van <strong id=\"accountholder\"></strong>",
			FormTitle:        "Personeelsdossier",
			FirstNames:       "Voornamen",
			FamilyName:       "Achternaam",
			DateOfBirth:      "Geboortedatum",
			Nationality:      "Nationaliteit",
			Address:          "Woonadres",
			Iban:             "Salarisrekening (IBAN)",
			DocumentPassport: "Paspoort",
			DocumentIdcard:   "Identiteitskaart",
			Success:          "✅ Bedankt, <strong id=\"name\"></strong>. Je identiteit is gecontroleerd en je personeelsdossier is compleet. Er is geen kopie van je identiteitsbewijs opgeslagen.",
			Error:            "❌ We konden je gegevens niet automatisch controleren. HR neemt contact met je op om je dossier persoonlijk af te ronden.",
		},
	),
}
