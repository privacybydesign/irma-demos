<?php
$content = [
	"intro" => "Useful for admissions offices that must verify prior education before admitting a student.",
	"benefits" => [
		"The diploma comes from DUO, so no certified copies or apostilles to check",
		"Level of the prior education checked automatically",
		"The applicant shares one diploma, not a whole transcript",
	],
	"data" => [
		"description" => "The diploma card",
		"sources" => [
			[
				"url" => "https://privacybydesign.foundation/uitgifte/diploma/",
				"label" => "DUO (via the Yivi diploma issuer)"
			]
		]
	],
	"sidenotes" => "Admission to a master’s programme requires a bachelor’s degree, and universities receive thousands of applications with uploaded diploma scans that have to be checked by hand or verified with DUO. With a diploma in the wallet the applicant shares the diploma card: name, education, degree, institution and the month it was achieved. The Yivi server verifies DUO’s signature on the card, so the university knows the diploma is genuine without seeing a scan. The page then only checks whether the degree gives access to a master’s programme. The same mechanism applies to micro-credentials and edubadges for individual courses, and to transcripts of records, once those are available as wallet cards."
];
