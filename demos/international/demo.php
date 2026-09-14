<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'international',
    'organisation' => [
        'en' => 'Waalstad University · International Office',
        'nl' => 'Universiteit Waalstad · International Office',
    ],
    'url' => [
        'en' => 'waalstad-university.example/international/arrival',
        'nl' => 'universiteit-waalstad.example/international/aankomst',
    ],
    'title' => [
        'en' => 'Complete your arrival registration',
        'nl' => 'Rond je aankomstregistratie af',
    ],
    'checks_title' => [
        'en' => 'Arrival checklist',
        'nl' => 'Aankomstchecklist',
    ],
    'check_document' => [
        'en' => 'Your <strong id="document"></strong> is valid until <strong id="expiry"></strong>',
        'nl' => 'Je <strong id="document"></strong> is geldig tot <strong id="expiry"></strong>',
    ],
    'check_municipality' => [
        'en' => 'You are registered with the municipality at <strong id="address"></strong>',
        'nl' => 'Je staat bij de gemeente ingeschreven op <strong id="address"></strong>',
    ],
    'check_eu' => [
        'en' => 'Nationality <strong id="nationality"></strong>: <span id="eu-text"></span>',
        'nl' => 'Nationaliteit <strong id="nationality"></strong>: <span id="eu-text"></span>',
    ],
    'eu_yes' => [
        'en' => 'EU/EEA citizen, no residence permit needed',
        'nl' => 'EU/EER-burger, geen verblijfsvergunning nodig',
    ],
    'eu_no' => [
        'en' => 'non-EU, we will apply for your residence permit with the IND',
        'nl' => 'niet-EU, wij vragen je verblijfsvergunning aan bij de IND',
    ],
    'document_passport' => [
        'en' => 'passport',
        'nl' => 'paspoort',
    ],
    'document_idcard' => [
        'en' => 'identity card',
        'nl' => 'identiteitskaart',
    ],
    'success' => [
        'en' => '✅ Welcome to Waalstad, <strong id="name"></strong>! Your arrival is registered. Your student account and campus access will be activated within one working day.',
        'nl' => '✅ Welkom in Waalstad, <strong id="name"></strong>! Je aankomst is geregistreerd. Je studentaccount en campustoegang worden binnen één werkdag geactiveerd.',
    ],
    'error' => [
        'en' => '❌ We can’t complete your arrival registration automatically. Please book an appointment with the International Office and bring your travel document.',
        'nl' => '❌ We kunnen je aankomstregistratie niet automatisch afronden. Maak een afspraak met het International Office en neem je reisdocument mee.',
    ],
    'action' => [
        'en' => 'Share your travel document and address',
        'nl' => 'Deel je reisdocument en adres',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #0b6b6b;
            --secondary: #ffffff;
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['checks_title'][$lang]; ?></h2>
        <ul class="checks" role="list">
            <li id="check-document"><span><?php echo $demo_strings['check_document'][$lang]; ?></span></li>
            <li id="check-municipality"><span><?php echo $demo_strings['check_municipality'][$lang]; ?></span></li>
            <li id="check-eu"><span><?php echo $demo_strings['check_eu'][$lang]; ?></span></li>
        </ul>
        <p class="success" hidden>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

    <script type="text/javascript">
        let eu_text = <?php echo json_encode([
            'yes' => $demo_strings['eu_yes'][$lang],
            'no' => $demo_strings['eu_no'][$lang],
        ]); ?>;
        let document_labels = <?php echo json_encode([
            'passport' => $demo_strings['document_passport'][$lang],
            'idcard' => $demo_strings['document_idcard'][$lang],
        ]); ?>;
    </script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
