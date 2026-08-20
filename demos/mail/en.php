<?php
$content = [
	"intro" => "Useful for letting people in with an email address from your own organisation, instead of yet another password.",
	"benefits" => [
		"Log in with an email address instead of a password",
		"Check only the domain, without learning the address",
		"The address is already verified, so no confirmation mail"
	],
	"data" => [
		"description" => "The email card",
		"sources" => [
			[
				"url" => "https://email-issuer.yivi.app",
				"label" => "the Yivi email issuer"
			]
		]
	],
	"actions" => [
		"gmail" => "Check for a gmail.com address",
		"email" => "Reveal my email address"
	],
	"sidenotes" => [
		"The domain check asks only for the domain of your address, not for the address itself: the site learns that you are at gmail.com without learning who you are. The same mechanism gives exclusive access to everyone with an address at one particular organisation, which is what makes it a replacement for a password.",
		"Whether the domain matches is decided in JavaScript in your own browser here. That is harmless in a demo, but it is not how this should be built: the check belongs on the server, where a visitor cannot reach it.",
		"No email addresses are kept. The addresses revealed here are used for this demo only and disappear the moment you close the page."
	]
];
