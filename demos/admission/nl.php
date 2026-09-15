<?php
$content = [
	"intro" => "Handig voor toelatingsbureaus die de vooropleiding moeten controleren voordat een student wordt toegelaten.",
	"benefits" => [
		"Het diploma komt uit het diplomaregister van DUO en is gekoppeld aan de identiteit van de houder",
		"Niveau van de vooropleiding automatisch gecontroleerd op het NLQF-niveau",
		"De aanmelder deelt één diploma, niet een hele cijferlijst of een PDF",
	],
	"data" => [
		"description" => "Het diplomakaartje",
		"sources" => [
			[
				"url" => "https://diploma.staging.yivi.app/nl",
				"label" => "het DUO-diploma-uittreksel (via diploma.staging.yivi.app)"
			]
		]
	],
	"sidenotes" => "Toelating tot een master vereist een bachelordiploma, en universiteiten krijgen duizenden aanmeldingen met geüploade diplomascans die met de hand of via DUO gecontroleerd moeten worden. Met een diploma in de wallet deelt de aanmelder het diplomakaartje: het soort document, de opleiding, het NLQF-niveau, de instelling, de datum waarop het is behaald en de naam van de houder. Het kaartje is gemaakt uit het digitaal ondertekende uittreksel van “Mijn diploma’s” (DUO) en bij uitgifte gekoppeld aan de identiteit van de houder, zodat de universiteit weet dat het diploma echt is en van deze persoon is zonder een PDF te zien. De pagina controleert daarna alleen of het NLQF-niveau (6 voor een bachelor) toegang geeft tot een masteropleiding. Hetzelfde mechanisme werkt voor microcredentials en edubadges voor losse vakken, en voor cijferlijsten (transcripts of records), zodra die als walletkaartjes beschikbaar zijn. Deze demo gebruikt het staging-schema; het diplomakaartje wordt uitgegeven op diploma.staging.yivi.app."
];
