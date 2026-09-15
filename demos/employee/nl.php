<?php
$content = [
	"intro" => "Handig voor HR-afdelingen die de identiteit van nieuwe medewerkers moeten vaststellen en hun gegevens vastleggen.",
	"benefits" => [
		"Identiteit gecontroleerd op basis van de chip in het paspoort, niet een fotokopie",
		"Personeelsdossier gevuld zonder typefouten: namen, adres, IBAN",
		"Controleert dat het document geldig is en de salarisrekening van de medewerker is",
	],
	"data" => [
		"description" => "Een reisdocumentkaartje, een adreskaartje en het IBAN-kaartje",
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
				"url" => "https://iban-issuer.yivi.app/nl",
				"label" => "je bank"
			]
		]
	],
	"sidenotes" => "Werkgevers zijn verplicht de identiteit van een nieuwe medewerker vóór de eerste werkdag vast te stellen aan de hand van een origineel identiteitsbewijs. In de praktijk mailen nieuwe medewerkers een kopie van hun paspoort naar HR, die de gegevens overtypt in het personeelssysteem en de kopie bewaart. In deze demo deelt de nieuwe medewerker het paspoort of de ID-kaart uit de wallet (bij het toevoegen uitgelezen uit de chip van het document), samen met het woonadres en het IBAN-kaartje van de bank. De universiteit ziet dat het document geldig is, controleert dat de salarisrekening op naam van de medewerker staat en vult het personeelsdossier. Omdat de kaartjes in de wallet door de uitgevers zijn ondertekend, hoeft er geen kopie van het document te worden bewaard."
];
