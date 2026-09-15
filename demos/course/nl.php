<?php
$content = [
	"intro" => "Handig om cursisten in te schrijven van wie de persoonsgegevens moeten kloppen met het paspoort, zonder DigiD.",
	"benefits" => [
		"Namen, geboortedatum en nationaliteit precies zoals in het paspoort of de BRP",
		"Geen typefouten en geen paspoortkopieën per e-mail",
		"Werkt ook voor cursisten die niet met DigiD kunnen of willen inloggen",
	],
	"data" => [
		"description" => "Een identiteitskaartje en het e-mailkaartje",
		"sources" => [
			[
				"label" => "paspoort"
			],
			[
				"label" => "ID-kaart"
			],
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "de basisregistratie (BRP)"
			],
			[
				"url" => "https://email-issuer.yivi.app/nl",
				"label" => "je e-mailadres"
			]
		]
	],
	"sidenotes" => "Universiteiten bieden onderwijs aan professionals die niet als reguliere student staan ingeschreven. Deze cursisten melden zich aan met een naam en een e-mailadres, maar op het moment dat ze zich formeel inschrijven moet de universiteit hun persoonsgegevens registreren zoals ze in het paspoort staan. Zonder DigiD betekent dat een paspoortkopie opvragen en overtypen. In deze demo deelt de cursist een identiteitskaartje uit de wallet (paspoort, ID-kaart of het BRP-kaartje van de gemeente) samen met het e-mailkaartje. Het inschrijfformulier wordt gevuld met de exacte geregistreerde waarden en laat zien uit welk document ze komen. Een rijbewijs wordt hier bewust niet geaccepteerd: daar staat geen nationaliteit op."
];
