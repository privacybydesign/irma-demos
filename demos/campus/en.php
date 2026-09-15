<?php
$content = [
	"intro" => "Useful as a replacement for the physical campus card: access and discounts based on being a student or employee.",
	"benefits" => [
		"One wallet card replaces the campus card at every gate, desk and till",
		"Only the role is shared, no name, photo or card number",
		"Lost cards are a thing of the past: the credential is renewed from the institution",
	],
	"data" => [
		"description" => "The education and research card",
		"sources" => [
			[
				"url" => "https://saml-issuer.yivi.app/en/surfconext/",
				"label" => "SURFconext"
			]
		]
	],
	"sidenotes" => "A campus card does two things: it proves that its holder is a student or employee, and it carries a number that other systems look up. The first part is exactly what a wallet credential does. In this demo the university library gate asks for the type (student or employee) and the institution from the education and research card, nothing else, and opens for both roles. The same disclosure gives the student rate at the sports centre, campus rates for printing and discounts in the campus shop, at whichever desk or till asks for it. Where a card number is needed, for example to borrow books or to reserve a sports hall, the student number on the same card can be requested in that specific session. In a real deployment the gate also checks that the institution is its own; this demo accepts any institution so that students and staff from anywhere can try it."
];
