<?php
$content = [
	"intro" => "Handig om persoonlijke, voorwaardelijke kaarten uit te geven",
	"benefits" => [
		"Geef een kaart uit op basis van ontvangen data",
		"De gebruiker hoeft Yivi maar één keer te openen"
	],
	"data" => [
		"description" => "Works with any card, but this demo uses a name for the member card;",
		"sources" => [
			[
				"url" => "https://yivi.nijmegen.nl/login",
				"label" => "de basisregistratie (BRP)"
			],
			[
				"label" => "paspoort"
			],
			[
				"label" => "rijbewijs"
			],
			[
				"label" => "ID-kaart"
			],
			[
				"url" => "https://saml-issuer.yivi.app/nl/linkedin/",
				"label" => "LinkedIn"
			]
		]
	],
	"more" => [
		"description" => "De YiviTube Premium lidmaatschapskaart kan worden gebruikt in deze YiviTube demo:",
		"links" => [
			[
				"label" => "YiviTube",
				"url" => "https://yivitube.yivi.app/"
			]
		]
	],
	"sidenotes" => "Deze demo laat ‘chained sessions’ zien: meerdere sessies (dus het ontvangen van data of uitgeven van een nieuwe kaart) gebeuren nadat de gebruiker maar één keer de Yivi QR-code scant (of op de knop drukt). De data van eerdere sessies (hier is dat de naam) kan gebruikt worden in latere sessies (hier is dat het lidmaatschap)."
];