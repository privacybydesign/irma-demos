<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'employee',
    'organisation' => [
        'en' => 'Waalstad University · HR',
        'nl' => 'Universiteit Waalstad · HR',
    ],
    'url' => [
        'en' => 'waalstad-university.example/hr/onboarding',
        'nl' => 'universiteit-waalstad.example/hr/indiensttreding',
    ],
    'title' => [
        'en' => 'Welcome aboard: complete your personnel file',
        'nl' => 'Welkom: vul je personeelsdossier aan',
    ],
    'checks_title' => [
        'en' => 'Identity verification',
        'nl' => 'Identiteitscontrole',
    ],
    'check_document' => [
        'en' => '<strong id="document"></strong> <strong id="documentnumber"></strong> is valid until <strong id="expiry"></strong>',
        'nl' => '<strong id="document"></strong> <strong id="documentnumber"></strong> is geldig tot <strong id="expiry"></strong>',
    ],
    'check_iban' => [
        'en' => 'The salary account is held by <strong id="accountholder"></strong>',
        'nl' => 'De salarisrekening staat op naam van <strong id="accountholder"></strong>',
    ],
    'form_title' => [
        'en' => 'Personnel file',
        'nl' => 'Personeelsdossier',
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
    'address' => [
        'en' => 'Home address',
        'nl' => 'Woonadres',
    ],
    'iban' => [
        'en' => 'Salary account (IBAN)',
        'nl' => 'Salarisrekening (IBAN)',
    ],
    'document_passport' => [
        'en' => 'Passport',
        'nl' => 'Paspoort',
    ],
    'document_idcard' => [
        'en' => 'Identity card',
        'nl' => 'Identiteitskaart',
    ],
    'success' => [
        'en' => '✅ Thanks, <strong id="name"></strong>. Your identity has been verified and your personnel file is complete. No copy of your identity document has been stored.',
        'nl' => '✅ Bedankt, <strong id="name"></strong>. Je identiteit is gecontroleerd en je personeelsdossier is compleet. Er is geen kopie van je identiteitsbewijs opgeslagen.',
    ],
    'error' => [
        'en' => '❌ We could not verify your details automatically. HR will contact you to complete your file in person.',
        'nl' => '❌ We konden je gegevens niet automatisch controleren. HR neemt contact met je op om je dossier persoonlijk af te ronden.',
    ],
    'action' => [
        'en' => 'Share your identity, address and IBAN',
        'nl' => 'Deel je identiteit, adres en IBAN',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #7a3e10;
            --secondary: #ffe8c9;
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['checks_title'][$lang]; ?></h2>
        <ul class="checks" role="list">
            <li id="check-document"><span><?php echo $demo_strings['check_document'][$lang]; ?></span></li>
            <li id="check-iban"><span><?php echo $demo_strings['check_iban'][$lang]; ?></span></li>
        </ul>

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
                <dt><?php echo $demo_strings['address'][$lang]; ?></dt>
                <dd id="address"></dd>
            </div>
            <div>
                <dt><?php echo $demo_strings['iban'][$lang]; ?></dt>
                <dd id="iban"></dd>
            </div>
        </dl>

        <p class="success" hidden>
            <?php echo $demo_strings['success'][$lang]; ?>
        </p>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

    <script type="text/javascript">
        let document_labels = <?php echo json_encode([
            'passport' => $demo_strings['document_passport'][$lang],
            'idcard' => $demo_strings['document_idcard'][$lang],
        ]); ?>;
    </script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
