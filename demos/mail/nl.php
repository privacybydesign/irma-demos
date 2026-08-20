<?php
$content = [
	"intro" => "Handig om mensen binnen te laten met een e-mailadres van je eigen organisatie, in plaats van weer een wachtwoord.",
	"benefits" => [
		"Inloggen met een e-mailadres in plaats van een wachtwoord",
		"Alleen het domein controleren, zonder het adres te leren",
		"Het adres is al gecontroleerd, dus geen bevestigingsmail"
	],
	"data" => [
		"description" => "Het e-mailkaartje",
		"sources" => [
			[
				"url" => "https://email-issuer.yivi.app",
				"label" => "de Yivi e-mailuitgifte"
			]
		]
	],
	"actions" => [
		"gmail" => "Controleer op een gmail.com-adres",
		"email" => "Toon mijn e-mailadres"
	],
	"sidenotes" => [
		"De domeincontrole vraagt alleen om het domein van je adres, niet om het adres zelf: de website leert dat je bij gmail.com zit, zonder te leren wie je bent. Ditzelfde mechanisme geeft uitsluitend toegang aan iedereen met een adres bij één bepaalde organisatie, en dat maakt het een vervanging voor een wachtwoord.",
		"Of het domein klopt wordt hier in JavaScript in je eigen browser bepaald. In een demo kan dat geen kwaad, maar zo hoort het niet: die controle hoort op de server, waar een bezoeker er niet bij kan.",
		"Er worden geen e-mailadressen bewaard. De adressen die je hier toont worden alleen voor deze demo gebruikt en verdwijnen zodra je de pagina sluit."
	]
];
