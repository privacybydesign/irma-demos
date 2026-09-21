<?php
$content = [
	"intro" => "Handig voor organisaties die na een sessie een persoonlijk wallet-kaartje uitgeven: hier wordt een paspoort een instapkaart.",
	"benefits" => [
		"Vereist het paspoortkaartje, dat je inlaadt door je paspoort te scannen met NFC, een zwaardere stap dan de andere demo’s hier",
		"De naam op de instapkaart komt direct van het paspoort, dus die kan niet verkeerd getypt worden en komt altijd overeen met je reisdocument",
		"Je houdt er een nieuw kaartje in je wallet aan over, niet alleen een gedeeld gegeven",
	],
	"data" => [
		"description" => "Het paspoortkaartje",
		"sources" => [
			[
				"label" => "paspoort"
			]
		]
	],
	"sidenotes" => "Deze demo laat een chained session zien: na het delen van je voor- en achternaam uit het paspoort, geeft een tweede sessie irma-demo.demo-airline.boardingpass rechtstreeks uit in je wallet, gevuld met die naam plus vaste demo-vluchtgegevens (vlucht Y256, AMS naar MXP, stoel 15B, gate 12). De demo zelf draait op een eigen site, los van deze; wat je daar deelt, wordt niet gedeeld met deze pagina."
];
