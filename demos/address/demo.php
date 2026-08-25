<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
	'slug' => 'address',
	'organisation' => [
        'en' => 'YourEnergy',
        'nl' => 'JouwEnergie',
    ],
    'title' => [
        'en' => 'View your electricity use',
        'nl' => 'Bekijk je stroomverbruik',
    ],
	'year' => [
        'en' => 'This year at',
		'nl' => 'Dit jaar op',
	],
    'action' => [
		'en' => 'Share your address',
		'nl' => 'Deel je adres',
    ]
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

<style>
	body {
		--accent: #712F87;
		--secondary: #F7E30F;
	}
	.result {
		> :first-child {
			font-size: max(3.5vw, 2em);
		}

		.number {
			font-size: 1.2em;
			font-weight: 900;
		}

		.year-at {
			text-transform: uppercase;
			font-size: 1em;
			letter-spacing: .1em;
			font-weight: 600;
		}
	}
</style>

<div class="result" hidden>
	<p>
		<span class="number">942</span>
		<span class="unit">kWh</span>
	</p>
	<p class="year-at">
		<?php echo $demo_strings['year'][$lang]; ?>
	</p>
	<p class="address">
		<span id="adres"></span>
		<br>
		<span id="postcode"></span>
		<span id="plaats"></span>
	</p>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>