<?php
$content = [
	"intro" => "Useful for admitting students to exams, on paper or digital, without checking student cards by hand.",
	"benefits" => [
		"Student status, institution and student number in one scan at the door",
		"Enrolment for the exam is verified against the registration, not a printout",
		"No queue for manual card checks, and no photos or copies of student cards",
	],
	"data" => [
		"description" => "The education and research card",
		"sources" => [
			[
				"url" => "https://saml-issuer.yivi.app/en/surfconext/",
				"label" => "SURFconext"
			]
		]
	],
	"sidenotes" => "At the entrance of an exam room, invigilators check that everyone who walks in is a student, is who they say they are and is actually enrolled for this exam. Today that is a student card and a printed registration list. In this demo a student shares the education and research card from the wallet: the name, the institution, the student/employee type and the student number. The university checks the student type and looks the student number up in its exam registration, then shows the room and seat. The check works the same for a digital exam: the same disclosure can unlock the exam environment on the student’s laptop. The enrolment lookup is simulated in this demo: every student with a student number is admitted."
];
