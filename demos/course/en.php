<?php
$content = [
	"intro" => "Useful for enrolling course participants whose personal data must match their passport, without DigiD.",
	"benefits" => [
		"Names, date of birth and nationality exactly as on the passport or in the BRP",
		"No typing errors and no copies of passports by email",
		"Works for participants who cannot or do not want to log in with DigiD",
	],
	"data" => [
		"description" => "An identity card and the email card",
		"sources" => [
			[
				"label" => "passport"
			],
			[
				"label" => "identity card"
			],
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "the Dutch resident registration (BRP)"
			],
			[
				"url" => "https://email-issuer.yivi.app/en",
				"label" => "your email address"
			]
		]
	],
	"sidenotes" => "Universities offer courses to professionals who are not enrolled as regular students. These participants sign up with a name and an email address, but the moment they formally enrol the university must register their personal data exactly as they appear on their passport. Without DigiD that means asking for a passport copy and retyping it. In this demo the participant shares an identity card from the wallet (passport, identity card or the BRP card issued by the municipality) together with the email card. The enrolment form is filled in with the exact registered values and shows which document they came from. A driving licence is deliberately not accepted here: it does not carry a nationality."
];
