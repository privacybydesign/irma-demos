<?php
$content = [
	"intro" => "Useful for webshops and services that offer a student discount and need to know the visitor really is one.",
	"benefits" => [
		"Prove you are a student without giving a name",
		"Or add your role and institution when that is needed",
		"Works for staff members just as well"
	],
	"data" => [
		"description" => "The education card",
		"sources" => [
			[
				"url" => "https://privacybydesign.foundation/issuance/surfconext/surfconext/?action=login",
				"label" => "SURFconext"
			]
		]
	],
	"actions" => [
		"student" => "Prove that I am a student",
		"school" => "Reveal my role and institution"
	],
	"sidenotes" => [
		"Several websites, such as <a href=\"https://www.amazon.com/joinstudent\" target=\"_blank\">Amazon</a>, offer discounts to students. How they actually establish that someone is a student is not always clear. The first check here reveals nothing beyond the fact itself, which is the privacy-friendly way to do it. The second one adds role and institution, so exclusive access can be arranged for the students or staff of one particular institution.",
		"SURFconext makes an email address available as well. It is deliberately left out of this demo, to avoid identifying data.",
		"Issuance of academic data is available only for students and staff of the institutions listed on the <a href=\"https://privacybydesign.foundation/issuance/surfconext/surfconext/\" target=\"_blank\">SURFconext issuance page</a>. Is yours missing? Then it has not switched on its connection to the Privacy by Design foundation, and you cannot load these data into your Yivi app. The best you can do is ask the people responsible for identity management at your institution to email <code>support'at'surfconext.nl</code> with the request: please give the Privacy by Design foundation access as Service Provider to our institution (in Dutch: <em>AUB de stichting Privacy by Design voor onze instelling toelaten als Service Provider</em>)."
	]
];
