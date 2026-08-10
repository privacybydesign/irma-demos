<?php
$yivi_details_strings = [
    'what' => [
        'en' => 'What is Yivi?',
        'nl' => 'Wat is Yivi?',
    ],
    'explanation' => [
        'en' => [
            'Yivi is an identity wallet. This is an app on your phone which allows you to securely share your personal information, online.',
            'For the user, it’s more privacy-friendly, since only specific information is shared. The receiver, on the other hand, can be sure the information is correct and true.'
        ],
        'nl' => [
            'Yivi is een identity wallet. Dit is een app op je telefoon waarmee je veilig, online jouw gegevens deelt.',
            'Voor de gebruiker is het privacyvriendelijker, omdat alleen specifieke informatie wordt gedeeld. De ontvanger kan er zeker van zijn dat de informatie klopt.'
        ]
    ],
    'read_more' => [
        'en' => 'Read more',
        'nl' => 'Lees meer'
    ],
    'get_yivi' => [
        'en' => 'Get Yivi',
        'nl' => 'Download Yivi'
    ],
    'getting_yivi' => [
        'en' => 'Getting Yivi',
        'nl' => 'Yivi downloaden'
    ],
    'app_stores' => [
        'en' => 'You can download Yivi from the app store of your operating system.',
        'nl' => 'Je kunt Yivi downloaden via de app store van je telefoon.',
    ],
    'appstore' => [
        'en' => 'Download on the App Store',
        'nl' => 'Download in de App Store'
    ],
    'googleplay' => [
        'en' => 'Get it on Google Play',
        'nl' => 'Ontdek het op Google Play'
    ],
    'fdroid' => [
        'en' => 'Get it on F-Droid',
        'nl' => 'Verkrijg op F-Droid'
    ]
]
?>

<script>
	function openGetYivi () {
		document.getElementById('get-yivi').setAttribute('open', true);
		document.getElementById('get-yivi').scrollIntoView();
	}
</script>
<details>
    <summary><?php echo $yivi_details_strings['what'][$lang]; ?></summary>
    <?php foreach ($yivi_details_strings['explanation'][$lang] as $paragraph) echo "<p>" . $paragraph . "</p>"; ?>
    <p>
        <a href="https://yivi.app" class="button" target="_blank">
            <?php echo $yivi_details_strings['read_more'][$lang]; ?></a>
        <button onclick="openGetYivi()">
            <?php echo $yivi_details_strings['get_yivi'][$lang]; ?></button>
    </p>
</details>
<details id="get-yivi">
    <summary><?php echo $yivi_details_strings['getting_yivi'][$lang]; ?></summary>
    <p>
        <?php echo $yivi_details_strings['app_stores'][$lang]; ?>
    </p>
    <ul class="stores">
        <li>
            <a href="https://apps.apple.com/nl/app/yivi/id1294092994" target="_blank">
                <img src="/resources/images/appstore-<?php echo $lang; ?>.svg" alt="<?php echo $yivi_details_strings['appstore'][$lang]; ?>>">
            </a>
        </li>
        <li>
            <a href="https://play.google.com/store/apps/details?id=org.irmacard.cardemu" target="_blank">
                <img src="/resources/images/googleplay-<?php echo $lang; ?>.svg" alt="<?php echo $yivi_details_strings['googleplay'][$lang]; ?>>">
            </a>
        </li>
        <li>
            <a href="https://f-droid.org/en/packages/org.irmacard.cardemu/" target="_blank">
                <img src="/resources/images/fdroid-<?php echo $lang; ?>.svg" alt="<?php echo $yivi_details_strings['fdroid'][$lang]; ?>>">
            </a>
        </li>
    </ul>
</details>
