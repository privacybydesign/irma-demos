<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'signature',
    'organisation' => [
        'en' => 'Gradez',
        'nl' => 'Cijferz',
    ],
    'url' => [
        'en' => 'gradez.example/sign',
        'nl' => 'cijferz.example/ondertekenen',
    ],
    'title' => [
        'en' => 'Submit the grades',
        'nl' => 'Lever de cijfers in',
    ],
    'success' => [
        'en' => 'You signed the following statement: <strong id="signature"></strong>',
        'nl' => 'Je hebt het volgende ondertekend: <strong id="signature"></strong>',
    ],
    'action' => [
        'en' => 'Sign the grades',
        'nl' => 'Onderteken de cijfers',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #00397e;
            --secondary: #afcaff;
        }
    </style>

    <div class="result" hidden>
        <p>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <ul>
            <li id="a"></li>
            <li id="b"></li>
            <li id="c"></li>
            <li id="d"></li>
        </ul>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>