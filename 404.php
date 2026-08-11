<?php

$not_found_page_strings = [
    'title' => [
        'en' => 'Page not found (404)',
        'nl' => 'Pagina niet gevonden (404)',
    ],
    'description' => [
        'en' => 'We couldn’t find this page. Try the menu or <a href="https://github.com/privacybydesign/irma-demos/issues" target="_blank">open an issue on Github</a>.',
        'nl' => 'We konden deze pagina niet vinden. Probeer het menu of <a href="https://github.com/privacybydesign/irma-demos/issues" target="_blank">maak een issue aan op Github</a>.',
    ]
];

if(!isset($lang)) include($_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php');

$title = $not_found_page_strings['title'][$lang];

include($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>

<h1><?php echo $title; ?></h1>
<p><?php echo $not_found_page_strings['description'][$lang]; ?></p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
