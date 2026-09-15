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
    'qualification' => [
        'en' => 'Qualification',
        'nl' => 'Opleiding',
    ],
    'level' => [
        'en' => 'NLQF level',
        'nl' => 'NLQF-niveau',
    ],
    'institution' => [
        'en' => 'Awarded by',
        'nl' => 'Behaald bij',
    ],
    'awarded' => [
        'en' => 'Date awarded',
        'nl' => 'Datum behaald',
    ],
    'holder' => [
        'en' => 'Diploma holder',
        'nl' => 'Op naam van',
    ],
    'check_diploma' => [
        'en' => 'The <strong id="documenttype"></strong> comes from the DUO diploma register and is bound to the holder’s identity',
        'nl' => 'Het <strong id="documenttype"></strong> komt uit het diplomaregister van DUO en is gekoppeld aan de identiteit van de houder',
    ],
    'check_level' => [
        'en' => '<span id="level-text"></span> gives access to a master’s programme (NLQF 6 or higher)',
        'nl' => '<span id="level-text"></span> geeft toegang tot een masteropleiding (NLQF 6 of hoger)',
    ],
    'level_known' => [
        'en' => 'NLQF level <strong>%s</strong>',
        'nl' => 'NLQF-niveau <strong>%s</strong>',
    ],
    'level_unknown' => [
        'en' => 'The qualification',
        'nl' => 'De opleiding',
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
                <dt><?php echo $demo_strings['qualification'][$lang]; ?></dt>
                <dd id="qualification"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['level'][$lang]; ?></dt>
                <dd id="level"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['institution'][$lang]; ?></dt>
                <dd id="institution"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['awarded'][$lang]; ?></dt>
                <dd id="awarded"></dd>
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

    <script type="text/javascript">
        let level_text = <?php echo json_encode([
            'known' => $demo_strings['level_known'][$lang],
            'unknown' => $demo_strings['level_unknown'][$lang],
        ]); ?>;
    </script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
