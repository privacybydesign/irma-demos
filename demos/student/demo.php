<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'student',
    'organisation' => [
        'en' => 'WebDot',
        'nl' => 'WebDot',
    ],
    'url' => [
        'en' => 'webdot.example/students',
        'nl' => 'webdot.example/studenten',
    ],
    'title' => [
        'en' => 'Buy with student discount',
        'nl' => 'Kopen met studentenkorting',
    ],
    'software' => [
        'en' => 'ExpensiveSuite XY',
        'nl' => 'ExpensiveSuite XY',
    ],
	'discount' => [
        'en' => 'With student discount',
		'nl' => 'Met studentenkorting',
	],
    'cart' => [
        'en' => 'Add to cart',
        'nl' => 'Voeg toe aan winkelwagen',
    ],
	'error' => [
	    'en' => 'You did not prove that you are a student, but a <strong id="proof"></strong>.',
	    'nl' => 'Je hebt niet bewezen dat je een student bent, maar een <strong id="proof"></strong>.'
	],
    'action' => [
        'en' => 'Prove you’re a student',
        'nl' => 'Toon aan dat je studeert',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #8f0000;
            --secondary: #ffffff;
        }
    </style>

    <div class="result" hidden>

		<div class="success" hidden>
            <div class="art"></div>
            <div>
                <h2>
                    <?php echo $demo_strings['software'][$lang]; ?>
                </h2>
                <p>
                    <?php echo $demo_strings['discount'][$lang]; ?>
                </p>
                <p class="price">
                    <span class="prev">€600</span>
                    €120
                </p>
                <button disabled>
                    <?php echo $demo_strings['cart'][$lang]; ?>
                </button>
            </div>
		</div>

		<div class="error" hidden>
			<?php echo $demo_strings['error'][$lang]; ?>
		</div>

    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>