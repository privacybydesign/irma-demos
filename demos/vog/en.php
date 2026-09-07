<?php
$content = [
	"intro" => "Useful for sports clubs and other organisations onboarding volunteers who work with children.",
	"benefits" => [
		"Identity and certificate of conduct (VOG) verified in one go",
		"No copies of ID documents or paper VOGs to collect and store",
		"Automatically checks that the VOG covers working with minors and is recent",
	],
	"data" => [
		"description" => "The personal data card and the VOG card",
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
				"url" => "https://vog.yivi.app/en",
				"label" => "Justis (via vog.yivi.app)"
			]
		]
	],
	"sidenotes" => "Sports clubs and other volunteer organisations that work with minors are expected to ask new volunteers for a Verklaring Omtrent het Gedrag (VOG), the Dutch certificate of conduct. Today that means collecting paper certificates and copies of ID documents, checking by hand that the names match, and keeping those documents around. With Yivi the volunteer shares an identity card and the VOG card from the wallet in a single session. The club immediately sees that the VOG belongs to this person, that the screening covered working with minors (function aspect 84) and that it is recent enough, without storing any documents. In this demo a VOG may be at most six months old."
];
