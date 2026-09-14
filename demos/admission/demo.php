<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'admission',
    'organisation' => [
        'en' => 'Waalstad University · Admissions',
        'nl' => 'Universiteit Waalstad · Toelating',
    ],
    'url' => [
        'en' => 'waalstad-university.example/masters/artificial-intelligence/apply',
        'nl' => 'universiteit-waalstad.example/masters/kunstmatige-intelligentie/aanmelden',
    ],
    'title' => [
        'en' => 'Apply for the Master’s in Artificial Intelligence',
        'nl' => 'Meld je aan voor de master Kunstmatige Intelligentie',
    ],
    'checks_title' => [
        'en' => 'Prior education',
        'nl' => 'Vooropleiding',
    ],
    'education' => [
        'en' => 'Education',
        'nl' => 'Opleiding',
    ],
    'degree' => [
        'en' => 'Degree',
        'nl' => 'Graad',
    ],
    'institute' => [
        'en' => 'Awarded by',
        'nl' => 'Behaald bij',
    ],
    'achieved' => [
        'en' => 'Achieved in',
        'nl' => 'Behaald in',
    ],
    'holder' => [
        'en' => 'Diploma holder',
        'nl' => 'Op naam van',
    ],
    'check_diploma' => [
        'en' => 'The diploma is issued by DUO and has not been tampered with',
        'nl' => 'Het diploma is uitgegeven door DUO en is niet gewijzigd',
    ],
    'check_level' => [
        'en' => 'The diploma gives access to a master’s programme',
        'nl' => 'Het diploma geeft toegang tot een masteropleiding',
    ],
    'success' => [
        'en' => '✅ Your prior education is verified, <strong id="name"></strong>. Your application is complete; the admissions committee will let you know within four weeks.',
        'nl' => '✅ Je vooropleiding is gecontroleerd, <strong id="name"></strong>. Je aanmelding is compleet; de toelatingscommissie laat binnen vier weken van zich horen.',
    ],
    'error' => [
        'en' => 'ℹ️ This diploma does not automatically give access. Your application has been forwarded to the admissions committee for an individual assessment.',
        'nl' => 'ℹ️ Dit diploma geeft niet automatisch toegang. Je aanmelding is doorgestuurd naar de toelatingscommissie voor een individuele beoordeling.',
    ],
    'action' => [
        'en' => 'Share your diploma',
        'nl' => 'Deel je diploma',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #3b3f8c;
            --secondary: #ffffff;
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['checks_title'][$lang]; ?></h2>
        <dl class="prefilled">
            <div>
                <dt><?php echo $demo_strings['education'][$lang]; ?></dt>
                <dd id="education"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['degree'][$lang]; ?></dt>
                <dd id="degree"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['institute'][$lang]; ?></dt>
                <dd id="institute"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['achieved'][$lang]; ?></dt>
                <dd id="achieved"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['holder'][$lang]; ?></dt>
                <dd id="holder"></dd>
            </div>
        </dl>
        <ul class="checks" role="list">
            <li id="check-diploma" class="ok"><span><?php echo $demo_strings['check_diploma'][$lang]; ?></span></li>
            <li id="check-level"><span><?php echo $demo_strings['check_level'][$lang]; ?></span></li>
        </ul>
        <p class="success" hidden>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
