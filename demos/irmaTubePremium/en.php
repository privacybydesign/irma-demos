<?php
$content = [
	"intro" => "Useful when one Yivi session has to feed the next: the card you receive carries a name you disclosed a moment earlier.",
	"benefits" => [
		"Issue a card that carries data from the session before it",
		"The visitor confirms once, not twice",
		"The new card can be used on other sites as well"
	],
	"data" => [
		"description" => "The name you become a member under",
		"sources" => [
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "the Dutch resident registration (BRP)"
			],
			[
				"label" => "passport"
			],
			[
				"label" => "identity card"
			],
			[
				"label" => "LinkedIn"
			]
		]
	],
	"session" => "irmatube_premium",
	"action" => "Become a premium member",
	"more" => [
		"description" => "The card you receive here is what unlocks the premium contents on the demo site it was made for:",
		"links" => [
			[
				"label" => "YiviTube",
				"url" => "https://yivitube.yivi.app"
			]
		]
	],
	"sidenotes" => [
		"This page shows <em>chained Yivi sessions</em>: several sessions in a row, where a later one may depend on an earlier one. Becoming a premium member starts a disclosure session that asks for your name, and the answer is fed straight into a second, issuing session — without asking you again. What comes out is a YiviTube membership card with your own name on it.",
		"YiviTube is not a real video-streaming service, but the card behaves like a real one. Once you have it, take it to the YiviTube page to watch (trailers of) movies and to open the premium contents.",
		"No personal data is retained via this page. What you reveal is used for this demo only and disappears the moment you close it."
	]
];
