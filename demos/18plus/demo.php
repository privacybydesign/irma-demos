<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => '18plus',
    'organisation' => [
        'en' => 'Gamiverse',
        'nl' => 'Gamiverse',
    ],
    'title' => [
        'en' => 'Buy Crimson Harbour VI (18+)',
        'nl' => 'Koop Crimson Harbour VI (18+)',
    ],
    'software' => [
        'en' => 'Crimson Harbour VI',
        'nl' => 'Crimson Harbour VI',
    ],
    'cart' => [
        'en' => 'Add to cart',
        'nl' => 'Voeg toe aan winkelwagen',
    ],
	'error' => [
	    'en' => 'You seem to be younger than 18, so you can’t buy this game. Sorry!',
	    'nl' => 'Je lijkt jonger te zijn dan 18, dus je mag dit spel niet kopen. Sorry!'
	],
    'action' => [
        'en' => 'Prove you’re older than 18',
        'nl' => 'Toon aan dat je ouder dan 18 bent',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #6c006b;
            --secondary: #bd91ff;
        }
    </style>

    <div class="result" hidden>

		<div class="success" hidden>
            <div class="art"></div>
            <div>
                <h2>
                    <?php echo $demo_strings['software'][$lang]; ?>
                </h2>
                <p class="price">
                    €59
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