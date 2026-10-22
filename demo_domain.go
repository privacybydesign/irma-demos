package main

import "html/template"

type domainStrings struct {
	Success template.HTML
	Event   string
}

var domainDemo = demo{
	slug:  "domain",
	label: localized[string]{EN: "Access with email address domain", NL: "Toegang met e-mailadres-domein"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to allow only members of an organisation access.",
			Benefits: []string{
				"Check if someone has an email address with your organisation’s domain",
				"No personal login required",
			},
			Data: cardData{
				Description: "The email address card",
				Sources: []source{
					{Label: "Yivi email address", URL: "https://email-issuer.yivi.app/en/"},
				},
			},
			Sidenotes: "",
		},
		NL: page{
			Intro: "Handig om alleen mensen van een organisatie toegang te geven.",
			Benefits: []string{
				"Controleer of iemand een emailadres heeft met jullie domeinnaam",
				"Geen persoonlijke login nodig",
			},
			Data: cardData{
				Description: "De emailadreskaart",
				Sources: []source{
					{Label: "Yivi emailadres", URL: "https://email-issuer.yivi.app/nl/"},
				},
			},
			Sidenotes: "",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "ACME Intranet",
			URL:          "intranet.acme.example",
			Title:        "Access our intranet",
			Action:       "Prove you’re part of ACME with your email address",
		},
		NL: frame{
			Organisation: "ACME Intranet",
			URL:          "intranet.acme.example",
			Title:        "Krijg toegang tot ons intranet",
			Action:       "Bewijs dat je deel bent van ACME met je emailadres",
		},
	},
	strings: both(
		domainStrings{
			Success: "Since <strong id=\"domain\"></strong> is our domain name, and only our people have email addresses ending in <strong id=\"domain-2\"></strong>, you can now access our intranet.",
			Event:   "Upcoming: Go-karting with the employee association",
		},
		domainStrings{
			Success: "Aangezien <strong id=\"domain\"></strong> onze domeinnaam is en alleen onze mensen een emailadres hebben dat eindigt op <strong id=\"domain-2\"></strong>, kun je nu ons intranet gebruiken.",
			Event:   "Binnenkort: Go-karten met de werknemersvereniging",
		},
	),
}
