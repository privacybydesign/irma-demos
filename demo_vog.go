package main

import "html/template"

type vogStrings struct {
	ChecksTitle   string
	CheckIdentity string
	CheckMinors   string
	CheckRecent   template.HTML
	Success       template.HTML
	Error         template.HTML
}

var vogDemo = demo{
	slug:  "vog",
	label: localized[string]{EN: "Volunteer onboarding (identity + VOG)", NL: "Vrijwilliger aanmelden (identiteit + VOG)"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for sports clubs and other organisations onboarding volunteers who work with children.",
			Benefits: []string{
				"Identity and certificate of conduct (VOG) verified in one go",
				"No copies of ID documents or paper VOGs to collect and store",
				"Automatically checks that the VOG covers working with minors and is recent",
			},
			Data: cardData{
				Description: "The personal data card and the VOG card",
				Sources: []source{
					{Label: "the Dutch resident registration (BRP)", URL: "https://yivi.nijmegen.nl/login"},
					{Label: "passport"},
					{Label: "driver’s license"},
					{Label: "identity card"},
					{Label: "Justis (via vog.yivi.app)", URL: "https://vog.yivi.app/en"},
				},
			},
			Sidenotes: "Sports clubs and other volunteer organisations that work with minors are expected to ask new volunteers for a Verklaring Omtrent het Gedrag (VOG), the Dutch certificate of conduct. Today that means collecting paper certificates and copies of ID documents, checking by hand that the names match, and keeping those documents around. With Yivi the volunteer shares an identity card and the VOG card from the wallet in a single session. The club immediately sees that the VOG belongs to this person, that the screening covered working with minors (function aspect 84) and that it is recent enough, without storing any documents. In this demo a VOG may be at most six months old.",
		},
		NL: page{
			Intro: "Handig voor sportclubs en andere organisaties die vrijwilligers aannemen die met kinderen werken.",
			Benefits: []string{
				"Identiteit en Verklaring Omtrent het Gedrag (VOG) in één keer gecontroleerd",
				"Geen kopieën van identiteitsbewijzen of papieren VOG’s verzamelen en bewaren",
				"Controleert automatisch of de VOG het werken met minderjarigen dekt en recent is",
			},
			Data: cardData{
				Description: "Het persoonsgegevenskaartje en het VOG-kaartje",
				Sources: []source{
					{Label: "de basisregistratie (BRP)", URL: "https://yivi.nijmegen.nl/login"},
					{Label: "paspoort"},
					{Label: "rijbewijs"},
					{Label: "ID-kaart"},
					{Label: "Justis (via vog.yivi.app)", URL: "https://vog.yivi.app/nl"},
				},
			},
			Sidenotes: "Van sportclubs en andere vrijwilligersorganisaties die met minderjarigen werken wordt verwacht dat ze nieuwe vrijwilligers om een Verklaring Omtrent het Gedrag (VOG) vragen. Nu betekent dat papieren verklaringen en kopieën van identiteitsbewijzen verzamelen, met de hand controleren of de namen overeenkomen, en die documenten bewaren. Met Yivi deelt de vrijwilliger in één sessie een identiteitskaartje en het VOG-kaartje uit de wallet. De club ziet direct dat de VOG bij deze persoon hoort, dat de screening het werken met minderjarigen (functieaspect 84) omvatte en dat de VOG recent genoeg is, zonder documenten op te slaan. In deze demo mag een VOG maximaal zes maanden oud zijn.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "FC Groenwit",
			URL:          "fcgroenwit.example/volunteers/sign-up",
			Title:        "Sign up as a youth trainer",
			Action:       "Share your identity and VOG",
		},
		NL: frame{
			Organisation: "FC Groenwit",
			URL:          "fcgroenwit.example/vrijwilligers/aanmelden",
			Title:        "Meld je aan als jeugdtrainer",
			Action:       "Deel je identiteit en VOG",
		},
	},
	strings: both(
		vogStrings{
			ChecksTitle:   "Onboarding checks",
			CheckIdentity: "The name and date of birth on the VOG match your identity",
			CheckMinors:   "The VOG covers working with minors (function aspect 84)",
			CheckRecent:   "The VOG is less than <strong id=\"limit\"></strong> months old",
			Success:       "✅ Welcome, <strong id=\"name\"></strong>! Your VOG of <strong id=\"issueDate\"></strong> has been recorded and you are registered as a youth trainer. See you on the pitch!",
			Error:         "❌ We can’t complete your registration automatically. Please <a href=\"https://www.justis.nl/en/products/certificate-of-conduct\" target=\"_blank\">request a new VOG</a> for working with minors, or contact the volunteer coordinator.",
		},
		vogStrings{
			ChecksTitle:   "Controles bij aanmelding",
			CheckIdentity: "De naam en geboortedatum op de VOG komen overeen met je identiteit",
			CheckMinors:   "De VOG dekt het werken met minderjarigen (functieaspect 84)",
			CheckRecent:   "De VOG is minder dan <strong id=\"limit\"></strong> maanden oud",
			Success:       "✅ Welkom, <strong id=\"name\"></strong>! Je VOG van <strong id=\"issueDate\"></strong> is vastgelegd en je bent geregistreerd als jeugdtrainer. Tot op het veld!",
			Error:         "❌ We kunnen je aanmelding niet automatisch afronden. <a href=\"https://www.justis.nl/producten/vog\" target=\"_blank\">Vraag een nieuwe VOG aan</a> voor het werken met minderjarigen, of neem contact op met de vrijwilligerscoördinator.",
		},
	),
}
