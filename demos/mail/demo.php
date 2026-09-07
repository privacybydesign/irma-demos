<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'mail',
    'organisation' => [
        'en' => 'Chatter',
        'nl' => 'Chatter',
    ],
    'url' => [
        'en' => 'chatter.example/login',
        'nl' => 'chatter.example/inloggen',
    ],
    'title' => [
        'en' => 'Register or log in',
        'nl' => 'Registreer of log in',
    ],
    'success' => [
        'en' => 'You’re now logged in as <strong id="email"></strong>.',
        'nl' => 'Je bent nu ingelogd als <strong id="email"></strong>.'
    ],
    'action' => [
        'en' => 'Share your email address',
        'nl' => 'Deel je emailadres',
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