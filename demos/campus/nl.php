<?php
$content = [
	"intro" => "Handig als vervanging van de fysieke campuskaart: toegang en korting op basis van het feit dat je student of medewerker bent.",
	"benefits" => [
		"Eén walletkaartje vervangt de campuskaart bij elke poort, balie en kassa",
		"Alleen de rol wordt gedeeld, geen naam, foto of kaartnummer",
		"Verloren kaarten zijn verleden tijd: het kaartje wordt vernieuwd vanuit de instelling",
	],
	"data" => [
		"description" => "De ‘onderwijs en onderzoek’-kaart",
		"sources" => [
			[
				"url" => "https://saml-issuer.yivi.app/nl/surfconext/",
				"label" => "SURFconext"
			]
		]
	],
	"sidenotes" => "Een campuskaart doet twee dingen: ze bewijst dat de houder student of medewerker is, en ze draagt een nummer dat andere systemen opzoeken. Het eerste is precies wat een walletkaartje doet. In deze demo vraagt de toegangspoort van de universiteitsbibliotheek alleen het type (student of medewerker) en de instelling van de ‘onderwijs en onderzoek’-kaart, en opent voor beide rollen. Dezelfde disclosure geeft het studententarief bij het sportcentrum, campustarieven voor printen en korting in de campuswinkel, bij welke balie of kassa er ook om vraagt. Waar een nummer nodig is, bijvoorbeeld om boeken te lenen of een sportzaal te reserveren, kan in die specifieke sessie het studentnummer van hetzelfde kaartje worden gevraagd. In een echte uitrol controleert de poort ook of de instelling de eigen instelling is; deze demo accepteert elke instelling zodat studenten en medewerkers van overal het kunnen proberen."
];
