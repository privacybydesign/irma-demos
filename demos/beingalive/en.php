<?php
$content = [
	"intro" => "Useful for insurers that periodically need proof that someone is still alive.",
	"benefits" => [
		"No trip to the town hall for an Attestatio de Vita",
		"Free, and done in under a minute",
		"The receiver can see the data are at most 14 days old"
	],
	"data" => [
		"description" => "The personal data card",
		"sources" => [
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "the Dutch resident registration (BRP)"
			]
		]
	],
	"action" => "Prove that I am alive",
	"sidenotes" => "Certain (life) insurances regularly ask for an <em>Attestatio de Vita</em>: evidence that the policyholder is still alive. This works because a Yivi card records when it was loaded. The demo asks for your family name, initials and date of birth, and accepts them only when they were loaded into your Yivi app less than 14 days ago — a certificate of life is only worth something if it is recent. If yours are older, refresh them via <a href=\"https://yivi.nijmegen.nl/login\">the BRP issuance page</a> and try again."
];
