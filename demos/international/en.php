<?php
$content = [
	"intro" => "Useful for universities and municipalities that register international students together.",
	"benefits" => [
		"One wallet, two organisations: the passport for the university and the address from the municipality",
		"Immediately clear whether a residence permit is needed",
		"No passport copies passed between the university and the municipality",
	],
	"data" => [
		"description" => "A travel document card and the address card",
		"sources" => [
			[
				"label" => "passport"
			],
			[
				"label" => "identity card"
			],
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "the municipality of Nijmegen"
			]
		]
	],
	"sidenotes" => "When international students arrive, they have to register with both the university and the municipality, and both need to see the same passport. The municipality of Nijmegen already issues the personal data and address cards to residents through Yivi. In this demo the university builds on that: the student shares the passport or identity card from the wallet together with the municipal address card. The university sees that the travel document is still valid, that the student is registered at an address in the city and whether the student is an EU citizen. That last answer decides the next step: EU citizens are done, for others the university starts the residence permit application with the IND. The student never hands over a passport copy."
];
