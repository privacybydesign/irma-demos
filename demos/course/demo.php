<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'course',
    'organisation' => [
        'en' => 'Waalstad University · Professional Education',
        'nl' => 'Universiteit Waalstad · Onderwijs voor Professionals',
    ],
    'url' => [
        'en' => 'waalstad-university.example/professionals/enrol',
        'nl' => 'universiteit-waalstad.example/professionals/inschrijven',
    ],
    'title' => [
        'en' => 'Enrol in Leadership in Healthcare',
        'nl' => 'Schrijf je in voor Leiderschap in de Zorg',
    ],
    'form_title' => [
        'en' => 'Your enrolment',
        'nl' => 'Je inschrijving',
    ],
    'first_names' => [
        'en' => 'First names',
        'nl' => 'Voornamen',
    ],
    'family_name' => [
        'en' => 'Family name',
        'nl' => 'Achternaam',
    ],
    'date_of_birth' => [
        'en' => 'Date of birth',
        'nl' => 'Geboortedatum',
    ],
    'nationality' => [
        'en' => 'Nationality',
        'nl' => 'Nationaliteit',
    ],
    'email' => [
        'en' => 'Email address',
        'nl' => 'E-mailadres',
    ],
    'source' => [
        'en' => 'Personal data taken from your <strong id="source"></strong>, exactly as registered there.',
        'nl' => 'Persoonsgegevens overgenomen van je <strong id="source"></strong>, precies zoals daar geregistreerd.',
    ],
    'source_passport' => [
        'en' => 'passport',
        'nl' => 'paspoort',
    ],
    'source_idcard' => [
        'en' => 'identity card',
        'nl' => 'identiteitskaart',
    ],
    'source_brp' => [
        'en' => 'municipal registration (BRP)',
        'nl' => 'inschrijving bij de gemeente (BRP)',
    ],
    'submit' => [
        'en' => 'Complete enrolment',
        'nl' => 'Inschrijving afronden',
    ],
    'action' => [
        'en' => 'Fill in with your identity and email',
        'nl' => 'Vul in met je identiteit en e-mail',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #6a2c70;
            --secondary: #f3d9f7;
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['form_title'][$lang]; ?></h2>
        <dl class="prefilled">
            <div>
                <dt><?php echo $demo_strings['first_names'][$lang]; ?></dt>
                <dd id="firstnames"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['family_name'][$lang]; ?></dt>
                <dd id="familyname"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['date_of_birth'][$lang]; ?></dt>
                <dd id="dateofbirth"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['nationality'][$lang]; ?></dt>
                <dd id="nationality"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['email'][$lang]; ?></dt>
                <dd id="email"></dd>
            </div>
        </dl>
        <p><?php echo $demo_strings['source'][$lang]; ?></p>
        <button disabled><?php echo $demo_strings['submit'][$lang]; ?></button>
    </div>

    <script type="text/javascript">
        let source_labels = <?php echo json_encode([
            'passport' => $demo_strings['source_passport'][$lang],
            'idcard' => $demo_strings['source_idcard'][$lang],
            'personalData' => $demo_strings['source_brp'][$lang],
        ]); ?>;
    </script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
