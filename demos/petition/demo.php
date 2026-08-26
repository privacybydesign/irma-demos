<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'petition',
    'organisation' => [
        'en' => 'ChangeIt',
        'nl' => 'VeranderT',
    ],
    'title' => [
        'en' => 'Sign the petition',
        'nl' => 'Onderteken de petitie',
    ],
    'success' => [
        'en' => 'Thanks for signing our petition! You could only sign this petition because you live in <strong id="city"></strong>.',
        'nl' => 'Bedankt voor het ondertekenen van onze petitie! Je kon deze petitie alleen wonen omdat je in <strong id="city"></strong> woont.'
    ],
    'action' => [
        'en' => 'Share your place of residence and sign',
        'nl' => 'Deel je woonplaats en onderteken',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #cd7d9e;
            --secondary: #3c002c;
        }
    </style>

    <div class="result" hidden>
        <p>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>