<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'iban',
    'organisation' => [
        'en' => 'Fitz',
        'nl' => 'Fitz',
    ],
    'title' => [
        'en' => 'Switch to direct debit',
        'nl' => 'Wissel naar automatische incasso',
    ],
    'success' => [
        'en' => 'Do you want to switch your €20/month gym subscription to direct debit from this bank account?',
        'nl' => 'Wil je je sportschool-abonnement van €20/maand wisselen naar een automatische incasso van deze bankrekening?'
    ],
    'name' => [
        'en' => 'Owner:',
        'nl' => 'T.n.v.:'
    ],
    'agree' => [
        'en' => 'I agree with a monthly direct debit',
        'nl' => 'Ik ga akkoord met een maandelijkse afschrijving'
    ],
    'button' => [
        'en' => 'Save',
        'nl' => 'Opslaan'
    ],
    'action' => [
        'en' => 'Share your bank details',
        'nl' => 'Deel je bankgegevens',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #9e5900;
            --secondary: #ffffff;
        }
        label {
            display: block;
            margin: 1em 0;
        }
        [type=checkbox] {
            width: 1.2em;
        }
        button[disabled] {
            font: inherit;
            font-weight: bold;
            padding: 12px 16px;
			background: dimgrey;

			&:hover {
				background: dimgrey;
			}
        }
    </style>

    <div class="result" hidden>
        <?php echo $demo_strings['success'][$lang]; ?>
        <ul>
            <li>
                IBAN: <strong id="iban"></strong>
            </li>
            <li>
                BIC: <strong id="bic"></strong>
            </li>
            <li>
                <?php echo $demo_strings['name'][$lang]; ?> <strong id="fullName"></strong>
            </li>
        </ul>
        <label>
            <input type="checkbox">
            <?php echo $demo_strings['agree'][$lang]; ?>
        </label>
        <button disabled>
            <?php echo $demo_strings['button'][$lang]; ?>
        </button>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>