package main

import "html/template"

type campusStrings struct {
	Granted        string
	Denied         string
	RoleStudent    string
	RoleEmployee   string
	At             string
	PerksTitle     string
	PerkSports     template.HTML
	SportsStudent  string
	SportsEmployee string
	PerkPrint      string
	PerkShop       string
	Error          template.HTML
}

var campusDemo = demo{
	slug:  "campus",
	label: localized[string]{EN: "Campus card in your wallet", NL: "Campuskaart in je wallet"},
	page: localized[page]{
		EN: page{
			Intro: "Useful as a replacement for the physical campus card: access and discounts based on being a student or employee.",
			Benefits: []string{
				"One wallet card replaces the campus card at every gate, desk and till",
				"Only the role is shared, no name, photo or card number",
				"Lost cards are a thing of the past: the credential is renewed from the institution",
			},
			Data: cardData{
				Description: "The education and research card",
				Sources: []source{
					{Label: "SURFconext", URL: surfconextENURL},
				},
			},
			Sidenotes: "A campus card does two things: it proves that its holder is a student or employee, and it carries a number that other systems look up. The first part is exactly what a wallet credential does. In this demo the university library gate asks for the type (student or employee) and the institution from the education and research card, nothing else, and opens for both roles. The same disclosure gives the student rate at the sports centre, campus rates for printing and discounts in the campus shop, at whichever desk or till asks for it. Where a card number is needed, for example to borrow books or to reserve a sports hall, the student number on the same card can be requested in that specific session. In a real deployment the gate also checks that the institution is its own; this demo accepts any institution so that students and staff from anywhere can try it.",
		},
		NL: page{
			Intro: "Handig als vervanging van de fysieke campuskaart: toegang en korting op basis van het feit dat je student of medewerker bent.",
			Benefits: []string{
				"Eén walletkaartje vervangt de campuskaart bij elke poort, balie en kassa",
				"Alleen de rol wordt gedeeld, geen naam, foto of kaartnummer",
				"Verloren kaarten zijn verleden tijd: het kaartje wordt vernieuwd vanuit de instelling",
			},
			Data: cardData{
				Description: "De ‘onderwijs en onderzoek’-kaart",
				Sources: []source{
					{Label: "SURFconext", URL: surfconextNLURL},
				},
			},
			Sidenotes: "Een campuskaart doet twee dingen: ze bewijst dat de houder student of medewerker is, en ze draagt een nummer dat andere systemen opzoeken. Het eerste is precies wat een walletkaartje doet. In deze demo vraagt de toegangspoort van de universiteitsbibliotheek alleen het type (student of medewerker) en de instelling van de ‘onderwijs en onderzoek’-kaart, en opent voor beide rollen. Dezelfde disclosure geeft het studententarief bij het sportcentrum, campustarieven voor printen en korting in de campuswinkel, bij welke balie of kassa er ook om vraagt. Waar een nummer nodig is, bijvoorbeeld om boeken te lenen of een sportzaal te reserveren, kan in die specifieke sessie het studentnummer van hetzelfde kaartje worden gevraagd. In een echte uitrol controleert de poort ook of de instelling de eigen instelling is; deze demo accepteert elke instelling zodat studenten en medewerkers van overal het kunnen proberen.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University · Campus",
			URL:          "waalstad-university.example/campus/gate/library",
			Title:        "University Library: entrance gate",
			Action:       "Show your campus role",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad · Campus",
			URL:          "universiteit-waalstad.example/campus/poort/bibliotheek",
			Title:        "Universiteitsbibliotheek: toegangspoort",
			Action:       "Toon je rol op de campus",
		},
	},
	strings: both(
		campusStrings{
			Granted:        "Access granted",
			Denied:         "Access denied",
			RoleStudent:    "Student",
			RoleEmployee:   "Employee",
			At:             "at",
			PerksTitle:     "Also unlocked on campus with this card",
			PerkSports:     "Sports centre: <strong id=\"sports-rate\"></strong>",
			SportsStudent:  "student rate, check in at the hall with your wallet",
			SportsEmployee: "staff rate, check in at the hall with your wallet",
			PerkPrint:      "Printing and copying at campus rate",
			PerkShop:       "Campus shop and restaurants: discount",
			Error:          "Your card says <strong id=\"type\"></strong>, which does not give access to this building. Visitors can register at the reception desk.",
		},
		campusStrings{
			Granted:        "Toegang verleend",
			Denied:         "Geen toegang",
			RoleStudent:    "Student",
			RoleEmployee:   "Medewerker",
			At:             "bij",
			PerksTitle:     "Ook geopend op de campus met dit kaartje",
			PerkSports:     "Sportcentrum: <strong id=\"sports-rate\"></strong>",
			SportsStudent:  "studententarief, check in bij de zaal met je wallet",
			SportsEmployee: "medewerkerstarief, check in bij de zaal met je wallet",
			PerkPrint:      "Printen en kopiëren tegen campustarief",
			PerkShop:       "Campuswinkel en restaurants: korting",
			Error:          "Op je kaartje staat <strong id=\"type\"></strong>, dat geeft geen toegang tot dit gebouw. Bezoekers kunnen zich melden bij de receptie.",
		},
	),
}
