package main

import "html/template"

type signatureStrings struct {
	Success template.HTML
}

var signatureDemo = demo{
	slug:  "signature",
	label: localized[string]{EN: "Digital signatures", NL: "Digitale handtekeningen"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to get digital signatures, for example for course grades.",
			Benefits: []string{
				"No more printing and scanning",
				"Quick signing",
			},
			Data: cardData{
				Description: "The education and research card",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/en/surfconext/"},
				},
			},
			Sidenotes: "Attribute-based digital signatures offer many new possibilities: a police officer, for instance, can sign a report with his/her name and police-registration number; in this way the integrity and authenticity of this report is guaranteed in the whole criminal justice chain. Also, a medical doctor can sign a medical statement with his/her own medical credentials, so that everyone can verify that this statement is actually signed by a medical doctor (and also by whom). Within organisations all kinds of decisions can be registered reliably and verifiably with digital signatures. Yivi is the only identity platform that seamlessly combines both authentication and signing.",
		},
		NL: page{
			Intro: "Handig om digitale handtekeningen te krijgen, bijvoorbeeld voor cijfers.",
			Benefits: []string{
				"Niet meer printen en scannen",
				"Snel ondertekenen",
			},
			Data: cardData{
				Description: "De ‘onderwijs en onderzoek’-kaart",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/en/surfconext/"},
				},
			},
			Sidenotes: "Digitale handtekeningen op basis van attributen bieden veel nieuwe mogelijkheden: een politiebeambte kan bijvoorbeeld een proces verbaal ondertekenen met hun naam en politie-registratienummer, als persoonlijke gegevens uit Yivi; daarmee wordt de integriteit en authenticiteit van dit proces verbaal in de hele verdere justitiële keten gegarandeerd. Ook kan een arts een medische verklaring met de eigen AGB-registratie gegevens als Yivi gegevens ondertekenen, zodat iedereen kan controleren dat deze verklaring daadwerkelijk door een arts (en ook welke) getekend is. Binnen organisaties kunnen allerlei beslissingen met digitale handtekeningen betrouwbaar en controleerbaar vastgelegd worden. Yivi is het enige platform dat dergelijke geïntegreerde authenticatie en ondertekening biedt.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Gradez",
			URL:          "gradez.example/sign",
			Title:        "Submit the grades",
			Action:       "Sign the grades",
		},
		NL: frame{
			Organisation: "Cijferz",
			URL:          "cijferz.example/ondertekenen",
			Title:        "Lever de cijfers in",
			Action:       "Onderteken de cijfers",
		},
	},
	strings: both(
		signatureStrings{
			Success: "You signed the following statement: <strong id=\"signature\"></strong>",
		},
		signatureStrings{
			Success: "Je hebt het volgende ondertekend: <strong id=\"signature\"></strong>",
		},
	),
}
