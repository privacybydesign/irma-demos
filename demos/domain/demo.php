<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'domain',
    'organisation' => [
        'en' => 'ACME Intranet',
        'nl' => 'ACME Intranet',
    ],
    'title' => [
        'en' => 'Access our intranet',
        'nl' => 'Krijg toegang tot ons intranet',
    ],
    'success' => [
        'en' => 'Since <strong id="domain"></strong> is our domain name, and only our people have email addresses ending in <strong id="domain-2"></strong>, you can now access our intranet.',
        'nl' => 'Aangezien <strong id="domain"></strong> onze domeinnaam is en alleen onze mensen een emailadres hebben dat eindigt op <strong id="domain-2"></strong>, kun je nu ons intranet gebruiken.'
    ],
    'action' => [
        'en' => 'Prove you’re part of ACME with your email address',
        'nl' => 'Bewijs dat je deel bent van ACME met je emailadres',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #097c6f;
            --secondary: #ffbf72;
        }
    </style>

    <div class="result" hidden>
        <p>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>