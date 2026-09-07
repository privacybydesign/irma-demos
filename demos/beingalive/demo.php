<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'beingalive',
    'organisation' => [
        'en' => 'OnePensioen',
        'nl' => 'EenPensioen',
    ],
    'url' => [
        'en' => 'onepensioen.example/my-pension',
        'nl' => 'eenpensioen.example/mijn-pensioen',
    ],
    'title' => [
        'en' => 'Prove you’re alive to continue your payout',
        'nl' => 'Bewijs dat je leeft om je uitbetaling voor te zetten',
    ],
    'data_age' => [
        'en' => 'The data you have shared is <strong id="dataAge"></strong> days old.',
        'nl' => 'De data die je hebt gedeeld is <strong id="dataAge"></strong> dagen oud.'
    ],
    'success' => [
        'en' => '✅ We will continue your pension payout, because you, <strong id="initials"></strong> <strong id="familyName"></strong> (<strong id="dateOfBirth"></strong>), have proven you are alive.',
        'nl' => '✅ We zullen doorgaan met je pensioen uitbetalen, omdat jij, <strong id="initials"></strong> <strong id="familyName"></strong> (<strong id="dateOfBirth"></strong>), hebt bewezen dat je nog leeft.'
    ],
    'error' => [
        'en' => '❌ To prove you are alive, your data should be no more than <strong id="limit"></strong> days old. Please <a href="https://yivi.nijmegen.nl/login">refresh your citizen registry data</a> and try again.',
        'nl' => '❌ Om te bewijzen dat je leeft, mag je data niet ouder dan <strong id="limit"></strong> dagen oud zijn. <a href="https://yivi.nijmegen.nl/login">Herlaad je persoonsgegevens</a> en probeer het opnieuw.'
    ],
    'action' => [
        'en' => 'Share your proof of life',
        'nl' => 'Deel bewijs dat je leeft',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #359a72;
            --secondary: #000000;
        }
    </style>

    <div class="result" hidden>
        <p>
            <?php echo $demo_strings['data_age'][$lang]; ?>
        </p>
        <p class="success" hidden>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>