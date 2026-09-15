<?php
$content = [
	"intro" => "Useful for HR departments that must verify the identity of new employees and record their details.",
	"benefits" => [
		"Identity verified against the chip of the passport, not a photocopy",
		"Personnel file filled in without typing errors: names, address, IBAN",
		"Checks that the document is valid and the salary account belongs to the employee",
	],
	"data" => [
		"description" => "A travel document card, an address card and the IBAN card",
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
				"url" => "https://iban-issuer.yivi.app/en",
				"label" => "your bank"
			]
		]
	],
	"sidenotes" => "Employers are obliged to verify the identity of a new employee against an original identity document before the first working day. In practice, new employees email a copy of their passport to HR, who retype the details into the personnel system and keep the copy. In this demo the new employee shares the passport or identity card from the wallet (read from the document’s chip when it was added), together with the home address and the IBAN card issued by the bank. The university sees that the document is valid, checks that the salary account is in the employee’s name and fills in the personnel file. Because the wallet cards are signed by their issuers, no copy of the document needs to be stored."
];
