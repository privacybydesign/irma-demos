<?php
$content = [
	"intro" => "Handig wanneer de ene Yivi-sessie de volgende moet voeden: het kaartje dat je krijgt draagt een naam die je even daarvoor toonde.",
	"benefits" => [
		"Geef een kaartje uit met gegevens uit de sessie ervoor",
		"De bezoeker bevestigt één keer, niet twee keer",
		"Het nieuwe kaartje is ook op andere sites te gebruiken"
	],
	"data" => [
		"description" => "De naam waaronder je lid wordt",
		"sources" => [
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "de Basisregistratie Personen (BRP)"
			],
			[
				"label" => "paspoort"
			],
			[
				"label" => "identiteitskaart"
			],
			[
				"label" => "LinkedIn"
			]
		]
	],
	"session" => "irmatube_premium",
	"action" => "Word premium lid",
	"more" => [
		"description" => "Het kaartje dat je hier krijgt is waarmee je de premium inhoud opent op de demosite waarvoor het gemaakt is:",
		"links" => [
			[
				"label" => "YiviTube",
				"url" => "https://yivitube.yivi.app"
			]
		]
	],
	"sidenotes" => [
		"Deze pagina demonstreert <em>chained Yivi sessions</em>: meerdere sessies achter elkaar, waarbij een latere sessie af mag hangen van een eerdere. Premium lid worden start een sessie die om je naam vraagt, en dat antwoord gaat rechtstreeks een tweede, uitgevende sessie in — zonder dat je het nog een keer bevestigt. Daar komt een YiviTube-lidmaatschapskaartje uit met je eigen naam erop.",
		"YiviTube is geen echte video-streamingdienst, maar het kaartje gedraagt zich als een echt kaartje. Zodra je het hebt, neem het mee naar de YiviTube-pagina om (trailers van) films te bekijken en de premium inhoud te openen.",
		"Er worden via deze pagina geen persoonsgegevens bewaard. Wat je toont wordt alleen voor deze demo gebruikt en verdwijnt zodra je de pagina sluit."
	]
];
