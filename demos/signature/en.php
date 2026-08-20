<?php
$content = [
	"intro" => "Useful wherever a statement has to be signed by a particular, verified person.",
	"benefits" => [
		"Sign with the personal data already in your wallet",
		"The receiver can check who signed, and with what",
		"No certificate or card reader needed"
	],
	"data" => [
		"description" => "The cards you sign with",
		"sources" => [
			[
				"url" => "https://yivi.app/en/storing_and_sharing/",
				"label" => "the Yivi issuance page"
			],
			[
				"url" => "https://privacybydesign.foundation/issuance/surfconext/surfconext/?action=login",
				"label" => "SURFconext"
			]
		]
	],
	"choose_first" => true,
	"actions" => [
		"email-signature" => "Consent to advertisements by email",
		"donation-signature" => "Promise a donation",
		"exam-signature" => "Declare an exam result"
	],
	"sidenotes" => [
		"None of these examples leads to an actual obligation. You can safely go through with the signing: the text you sign does not commit you to anything, and the resulting signature is not stored. After pressing a button a signing request appears in your Yivi app; on a phone the switch to the app happens automatically, on another device you first scan the QR code that appears.",
		"<strong>Advertisement.</strong> Here you are asked to give GDPR-style consent so that advertisements can be sent to you. The personal data you sign with is the email address at which you agree to receive them, and nothing further is disclosed — though in principle more could be included, such as your gender or date of birth, so that the advertisements are better targeted. A digital signature is the perfect way to record consent under the General Data Protection Regulation: it can be passed on to partner companies, who can check it themselves, and it can be shown to the regulator on request to demonstrate that the owner of the address actually agreed.",
		"<strong>Donation.</strong> Here you are asked to sign that you will contribute financially to the foundation (not really). You sign with your family name and your mobile phone number.",
		"<strong>Exam result.</strong> Here you are asked to sign, as a teacher, that a certain student has passed your exam. You sign with three items from SURFconext: your name, the educational institution where you work, and your email address at that institution.",
		"Attribute-based digital signatures open up many new possibilities. A police officer can sign a report with their name and police registration number, guaranteeing its integrity and authenticity throughout the criminal justice chain. A doctor can sign a medical statement with their own medical credentials, so that anyone can verify the statement really was signed by a doctor, and by which one. Within organisations all kinds of decisions can be recorded reliably and verifiably. Yivi is the only identity platform that seamlessly combines both authentication and signing."
	]
];
