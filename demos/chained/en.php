<?php
$content = [
	"intro" => "Useful to give out personal, conditional cards",
	"benefits" => [
		"Issue a card based on disclosed data",
		"The user only opens Yivi once"
	],
	"data" => [
		"description" => "Works with any card, but this demo uses a name for the member card;",
		"sources" => [
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "the Dutch resident registration (BRP)"
			],
			[
				"label" => "passport"
			],
			[
				"label" => "driver’s license"
			],
			[
				"label" => "identity card"
			],
			[
				"url" => "https://saml-issuer.yivi.app/en/linkedin/",
				"label" => "LinkedIn"
			]
		]
	],
	"more" => [
		"description" => "The YiviTube Premium membership card can be used in this YiviTube demo:",
		"links" => [
			[
				"label" => "YiviTube",
				"url" => "https://yivitube.yivi.app/"
			]
		]
	],
	"sidenotes" => "This demo shows chained sessions: multiple sessions (so disclosure of data or issuance of a new card) happen after the user scans the Yivi QR code (or presses the button) only once. The data from earlier sessions (here, the disclosed name) can be used in later sessions (here, the membership card)."
];