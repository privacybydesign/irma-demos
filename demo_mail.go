package main

import "html/template"

type mailStrings struct {
	Success template.HTML
}

var mailDemo = demo{
	slug:  "mail",
	label: localized[string]{EN: "Login with email address", NL: "Inloggen met e-mailadres"},
	page: localized[page]{
		EN: page{
			Intro: "Useful to allow logging in.",
			Benefits: []string{
				"Register with an email address",
				"No password required",
			},
			Data: cardData{
				Description: "The email address card",
				Sources: []source{
					{Label: "Yivi email address", URL: "https://email-issuer.yivi.app/en/"},
				},
			},
			Sidenotes: "By sharing an email address, a user proves that they own that email address. This provides the same level of security as a ‘magic login link’ or password reset link sent over email, but now the user doesn’t have to wait for the email to arrive. This means ‘logging in’ can happen by only sharing an email address from Yivi.",
		},
		NL: page{
			Intro: "Handig om inloggen mogelijk te maken.",
			Benefits: []string{
				"Registreer met een emailadres",
				"Geen wachtwoord nodig",
			},
			Data: cardData{
				Description: "De emailadreskaart",
				Sources: []source{
					{Label: "Yivi emailadres", URL: "https://email-issuer.yivi.app/nl/"},
				},
			},
			Sidenotes: "Door een emailadres te delen, bewijst een gebruiker dat ze dat emailadres hebben. Dat geeft dezelfde veiligheid als een ‘magic login link’ of wachtwoord-herstel-link die wordt verstuurd via email, maar hierbij hoeft de gebruiker niet op een email te wachten. Hierdoor kan iemand inloggen door alleen hun emailadres vanuit Yivi te delen.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Chatter",
			URL:          "chatter.example/login",
			Title:        "Register or log in",
			Action:       "Share your email address",
		},
		NL: frame{
			Organisation: "Chatter",
			URL:          "chatter.example/inloggen",
			Title:        "Registreer of log in",
			Action:       "Deel je emailadres",
		},
	},
	strings: both(
		mailStrings{
			Success: "You’re now logged in as <strong id=\"email\"></strong>.",
		},
		mailStrings{
			Success: "Je bent nu ingelogd als <strong id=\"email\"></strong>.",
		},
	),
}
