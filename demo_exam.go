package main

import "html/template"

type examStrings struct {
	Exam           string
	ChecksTitle    string
	CheckStudent   string
	CheckInstitute template.HTML
	CheckEnrolled  template.HTML
	Room           string
	Seat           string
	Starts         string
	Success        template.HTML
	Error          string
}

var examDemo = demo{
	slug:  "exam",
	label: localized[string]{EN: "Exam check-in", NL: "Toegang tot het tentamen"},
	page: localized[page]{
		EN: page{
			Intro: "Useful for admitting students to exams, on paper or digital, without checking student cards by hand.",
			Benefits: []string{
				"Student status, institution and student number in one scan at the door",
				"Enrolment for the exam is verified against the registration, not a printout",
				"No queue for manual card checks, and no photos or copies of student cards",
			},
			Data: cardData{
				Description: "The education and research card",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/en/surfconext/"},
				},
			},
			Sidenotes: "At the entrance of an exam room, invigilators check that everyone who walks in is a student, is who they say they are and is actually enrolled for this exam. Today that is a student card and a printed registration list. In this demo a student shares the education and research card from the wallet: the name, the institution, the student/employee type and the student number. The university checks the student type and looks the student number up in its exam registration, then shows the room and seat. The check works the same for a digital exam: the same disclosure can unlock the exam environment on the student’s laptop. The enrolment lookup is simulated in this demo: every student with a student number is admitted.",
		},
		NL: page{
			Intro: "Handig om studenten toe te laten tot tentamens, op papier of digitaal, zonder handmatig collegekaarten te controleren.",
			Benefits: []string{
				"Studentstatus, instelling en studentnummer in één scan bij de deur",
				"Inschrijving voor het tentamen wordt gecontroleerd in de registratie, niet op een print",
				"Geen rij voor handmatige controles en geen foto’s of kopieën van collegekaarten",
			},
			Data: cardData{
				Description: "De ‘onderwijs en onderzoek’-kaart",
				Sources: []source{
					{Label: "SURFconext", URL: "https://saml-issuer.yivi.app/nl/surfconext/"},
				},
			},
			Sidenotes: "Bij de ingang van een tentamenzaal controleren surveillanten of iedereen die binnenkomt student is, is wie hij of zij zegt te zijn en ook echt is ingeschreven voor dit tentamen. Nu gaat dat met een collegekaart en een geprinte inschrijflijst. In deze demo deelt een student de ‘onderwijs en onderzoek’-kaart uit de wallet: de naam, de instelling, het type (student of medewerker) en het studentnummer. De universiteit controleert het type en zoekt het studentnummer op in de tentameninschrijving, en toont daarna zaal en plaats. Bij een digitaal tentamen werkt het hetzelfde: dezelfde disclosure kan de toetsomgeving op de laptop van de student ontsluiten. De inschrijfcontrole is in deze demo gesimuleerd: elke student met een studentnummer wordt toegelaten.",
		},
	},
	frame: localized[frame]{
		EN: frame{
			Organisation: "Waalstad University",
			URL:          "waalstad-university.example/exams/check-in",
			Title:        "Check in for your exam",
			Action:       "Show your student registration",
		},
		NL: frame{
			Organisation: "Universiteit Waalstad",
			URL:          "universiteit-waalstad.example/tentamens/inchecken",
			Title:        "Check in voor je tentamen",
			Action:       "Toon je studentregistratie",
		},
	},
	strings: both(
		examStrings{
			Exam:           "Foundations of Computer Science",
			ChecksTitle:    "Check-in",
			CheckStudent:   "You are registered as a student",
			CheckInstitute: "Your registration is at <strong id=\"institute\"></strong>",
			CheckEnrolled:  "Student number <strong id=\"studentnumber\"></strong> is enrolled for this exam",
			Room:           "Room",
			Seat:           "Seat",
			Starts:         "Starts",
			Success:        "✅ Welcome, <strong id=\"name\"></strong>. Take your seat, the exam paper is on the desk. Good luck!",
			Error:          "❌ We can’t admit you automatically. Please report to the invigilator at the desk with your student card.",
		},
		examStrings{
			Exam:           "Grondslagen van de Informatica",
			ChecksTitle:    "Controle bij binnenkomst",
			CheckStudent:   "Je bent geregistreerd als student",
			CheckInstitute: "Je registratie is bij <strong id=\"institute\"></strong>",
			CheckEnrolled:  "Studentnummer <strong id=\"studentnumber\"></strong> is ingeschreven voor dit tentamen",
			Room:           "Zaal",
			Seat:           "Plaats",
			Starts:         "Aanvang",
			Success:        "✅ Welkom, <strong id=\"name\"></strong>. Neem plaats, het tentamen ligt klaar op je tafel. Succes!",
			Error:          "❌ We kunnen je niet automatisch toelaten. Meld je met je collegekaart bij de surveillant aan de balie.",
		},
	),
}
