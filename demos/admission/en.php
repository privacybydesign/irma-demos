<?php
$content = [
	"intro" => "Useful for admissions offices that must verify prior education before admitting a student.",
	"benefits" => [
		"The diploma comes from the DUO diploma register and is bound to the holder’s identity",
		"Level of the prior education checked automatically on the NLQF level",
		"The applicant shares one diploma, not a whole transcript or a PDF",
	],
	"data" => [
		"description" => "The diploma card",
		"sources" => [
			[
				"url" => "https://diploma.staging.yivi.app/en",
				"label" => "the DUO diploma extract (via diploma.staging.yivi.app)"
			]
		]
	],
	"sidenotes" => "Admission to a master’s programme requires a bachelor’s degree, and universities receive thousands of applications with uploaded diploma scans that have to be checked by hand or verified with DUO. With a diploma in the wallet the applicant shares the diploma card: the kind of document, the qualification, its NLQF level, the institution, the date awarded and the holder’s name. The card was created from the digitally signed extract of “Mijn diploma’s” (DUO) and bound to the holder’s identity when it was issued, so the university knows the diploma is genuine and belongs to this person without seeing a PDF. The page then only checks whether the NLQF level (6 for a bachelor’s) gives access to a master’s programme. The same mechanism applies to micro-credentials and edubadges for individual courses, and to transcripts of records, once those are available as wallet cards. This demo uses the staging scheme; the diploma card is issued at diploma.staging.yivi.app."
];
