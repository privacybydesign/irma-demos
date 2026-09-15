<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'campus',
    'organisation' => [
        'en' => 'Waalstad University · Campus',
        'nl' => 'Universiteit Waalstad · Campus',
    ],
    'url' => [
        'en' => 'waalstad-university.example/campus/gate/library',
        'nl' => 'universiteit-waalstad.example/campus/poort/bibliotheek',
    ],
    'title' => [
        'en' => 'University Library: entrance gate',
        'nl' => 'Universiteitsbibliotheek: toegangspoort',
    ],
    'granted' => [
        'en' => 'Access granted',
        'nl' => 'Toegang verleend',
    ],
    'denied' => [
        'en' => 'Access denied',
        'nl' => 'Geen toegang',
    ],
    'role_student' => [
        'en' => 'Student',
        'nl' => 'Student',
    ],
    'role_employee' => [
        'en' => 'Employee',
        'nl' => 'Medewerker',
    ],
    'at' => [
        'en' => 'at',
        'nl' => 'bij',
    ],
    'perks_title' => [
        'en' => 'Also unlocked on campus with this card',
        'nl' => 'Ook geopend op de campus met dit kaartje',
    ],
    'perk_sports' => [
        'en' => 'Sports centre: <strong id="sports-rate"></strong>',
        'nl' => 'Sportcentrum: <strong id="sports-rate"></strong>',
    ],
    'sports_student' => [
        'en' => 'student rate, check in at the hall with your wallet',
        'nl' => 'studententarief, check in bij de zaal met je wallet',
    ],
    'sports_employee' => [
        'en' => 'staff rate, check in at the hall with your wallet',
        'nl' => 'medewerkerstarief, check in bij de zaal met je wallet',
    ],
    'perk_print' => [
        'en' => 'Printing and copying at campus rate',
        'nl' => 'Printen en kopiëren tegen campustarief',
    ],
    'perk_shop' => [
        'en' => 'Campus shop and restaurants: discount',
        'nl' => 'Campuswinkel en restaurants: korting',
    ],
    'error' => [
        'en' => 'Your card says <strong id="type"></strong>, which does not give access to this building. Visitors can register at the reception desk.',
        'nl' => 'Op je kaartje staat <strong id="type"></strong>, dat geeft geen toegang tot dit gebouw. Bezoekers kunnen zich melden bij de receptie.',
    ],
    'action' => [
        'en' => 'Show your campus role',
        'nl' => 'Toon je rol op de campus',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #a8321a;
            --secondary: #ffffff;
        }

        .gate {
            display: flex;
            align-items: center;
            gap: 1.25em;
            margin-block: 0 1em;

            .light {
                flex-shrink: 0;
                width: 4em;
                height: 4em;
                border-radius: 50%;
                background: #2fbf5f;
                box-shadow: 0 0 2em #2fbf5f;
            }

            .light.red {
                background: #d23c3c;
                box-shadow: 0 0 2em #d23c3c;
            }

            .status {
                font-size: 1.8em;
                font-weight: bold;
                line-height: 1.1;
            }

            .role {
                opacity: .85;
                font-size: 1.1em;
            }
        }

        .perks {
            padding-inline-start: 1.25em;
            margin: .5em 0 0;

            li {
                margin-block: .35em;
            }
        }
    </style>

    <div class="result" hidden>
        <div class="success" hidden>
            <div class="gate">
                <div class="light"></div>
                <div>
                    <div class="status"><?php echo $demo_strings['granted'][$lang]; ?></div>
                    <div class="role">
                        <strong id="role"></strong>
                        <?php echo $demo_strings['at'][$lang]; ?>
                        <strong id="institute"></strong>
                    </div>
                </div>
            </div>
            <h2 class="checks-title"><?php echo $demo_strings['perks_title'][$lang]; ?></h2>
            <ul class="perks">
                <li><?php echo $demo_strings['perk_sports'][$lang]; ?></li>
                <li><?php echo $demo_strings['perk_print'][$lang]; ?></li>
                <li><?php echo $demo_strings['perk_shop'][$lang]; ?></li>
            </ul>
        </div>
        <div class="error" hidden>
            <div class="gate">
                <div class="light red"></div>
                <div class="status"><?php echo $demo_strings['denied'][$lang]; ?></div>
            </div>
            <p><?php echo $demo_strings['error'][$lang]; ?></p>
        </div>
    </div>

    <script type="text/javascript">
        let role_labels = <?php echo json_encode([
            'student' => $demo_strings['role_student'][$lang],
            'employee' => $demo_strings['role_employee'][$lang],
        ]); ?>;
        let sports_rates = <?php echo json_encode([
            'student' => $demo_strings['sports_student'][$lang],
            'employee' => $demo_strings['sports_employee'][$lang],
        ]); ?>;
    </script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
