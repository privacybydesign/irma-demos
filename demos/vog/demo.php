<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'vog',
    'organisation' => [
        'en' => 'FC Groenwit',
        'nl' => 'FC Groenwit',
    ],
    'url' => [
        'en' => 'fcgroenwit.example/volunteers/sign-up',
        'nl' => 'fcgroenwit.example/vrijwilligers/aanmelden',
    ],
    'title' => [
        'en' => 'Sign up as a youth trainer',
        'nl' => 'Meld je aan als jeugdtrainer',
    ],
    'checks_title' => [
        'en' => 'Onboarding checks',
        'nl' => 'Controles bij aanmelding',
    ],
    'check_identity' => [
        'en' => 'The name and date of birth on the VOG match your identity',
        'nl' => 'De naam en geboortedatum op de VOG komen overeen met je identiteit',
    ],
    'check_minors' => [
        'en' => 'The VOG covers working with minors (function aspect 84)',
        'nl' => 'De VOG dekt het werken met minderjarigen (functieaspect 84)',
    ],
    'check_recent' => [
        'en' => 'The VOG is less than <strong id="limit"></strong> months old',
        'nl' => 'De VOG is minder dan <strong id="limit"></strong> maanden oud',
    ],
    'success' => [
        'en' => '✅ Welcome, <strong id="name"></strong>! Your VOG of <strong id="issueDate"></strong> has been recorded and you are registered as a youth trainer. See you on the pitch!',
        'nl' => '✅ Welkom, <strong id="name"></strong>! Je VOG van <strong id="issueDate"></strong> is vastgelegd en je bent geregistreerd als jeugdtrainer. Tot op het veld!',
    ],
    'error' => [
        'en' => '❌ We can’t complete your registration automatically. Please <a href="https://www.justis.nl/en/products/certificate-of-conduct" target="_blank">request a new VOG</a> for working with minors, or contact the volunteer coordinator.',
        'nl' => '❌ We kunnen je aanmelding niet automatisch afronden. <a href="https://www.justis.nl/producten/vog" target="_blank">Vraag een nieuwe VOG aan</a> voor het werken met minderjarigen, of neem contact op met de vrijwilligerscoördinator.',
    ],
    'action' => [
        'en' => 'Share your identity and VOG',
        'nl' => 'Deel je identiteit en VOG',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #1f7a3a;
            --secondary: #ffffff;
        }

        .checks {
            list-style: none;
            padding: 0;
            margin: 0 0 1em;

            h2 {
                font-size: 1em;
                text-transform: uppercase;
                letter-spacing: .1em;
                margin-block: 0 .5em;
            }

            li {
                display: flex;
                gap: .75em;
                margin-block: .5em;
                font-size: 1.1em;
            }

            li::before {
                content: '•';
                flex-shrink: 0;
                width: 1.5em;
                height: 1.5em;
                line-height: 1.5em;
                text-align: center;
                border-radius: 50%;
                background: oklch(from white l c h / calc(alpha - .8));
                font-weight: bold;
            }

            li.ok::before {
                content: '✓';
                background: #2fbf5f;
                color: white;
            }

            li.fail::before {
                content: '✕';
                background: #d23c3c;
                color: white;
            }
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['checks_title'][$lang]; ?></h2>
        <ul class="checks" role="list">
            <li id="check-identity"><span><?php echo $demo_strings['check_identity'][$lang]; ?></span></li>
            <li id="check-minors"><span><?php echo $demo_strings['check_minors'][$lang]; ?></span></li>
            <li id="check-recent"><span><?php echo $demo_strings['check_recent'][$lang]; ?></span></li>
        </ul>
        <p class="success" hidden>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
