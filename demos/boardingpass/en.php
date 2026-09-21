<?php
$content = [
	"intro" => "Useful for organisations that hand out a personalised wallet card as the result of a session: here a passport becomes a boarding pass.",
	"benefits" => [
		"Needs the passport card, loaded by scanning your passport with NFC, a heavier step than the other demos here",
		"The name on the boarding pass comes straight from the passport, so it can’t be mistyped and always matches your travel document",
		"You walk away with a new card in your wallet, not just a disclosure",
	],
	"external" => [
		"url" => "https://boarding-pass.yivi.app",
		"description" => "This demo is hosted on its own site, not here. You need the passport card in your wallet before you start; you load it by scanning your passport with NFC.",
		"action" => "Open the boarding pass demo",
	],
	"data" => [
		"description" => "The passport card",
		"sources" => [
			[
				"label" => "passport"
			]
		]
	],
	"sidenotes" => "This demo shows a chained session: after disclosing your first and last name from the passport, a second session issues irma-demo.demo-airline.boardingpass directly into your wallet, filled with that name plus fixed demo flight data (flight Y256, AMS to MXP, seat 15B, gate 12). The demo itself runs on its own site, separate from this one; nothing you disclose there is shared with this page."
];
