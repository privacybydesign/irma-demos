<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'chained',
    'organisation' => [
        'en' => 'YiviTube',
        'nl' => 'YiviTube',
    ],
    'url' => [
        'en' => 'yivitube.example/upload',
        'nl' => 'yivitube.example/upload',
    ],
    'title' => [
        'en' => 'Become YiviTube Premium member',
        'nl' => 'Word YiviTube Premiumlid',
    ],
    'success' => [
        'en' => '<strong>You’re now a YiviTube Premium member!</strong> You can use the membership card on <a href="https://yivitube.yivi.app">YiviTube</a>.',
        'nl' => '<strong>Je bent nu een YiviTube Premiumlid!</strong> Je kunt de lidmaatschapskaart gebruiken op <a href="https://yivitube.yivi.app">YiviTube</a>.'
    ],
    'action' => [
        'en' => 'Share your name and get a membership',
        'nl' => 'Deel je naam en ontvang een lidmaatschap',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #BA3252;
            --secondary: #ffffff;
        }
    </style>

    <div class="result" hidden>
        <p>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>