<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'organisation' => [
        'en' => 'YourEnergy',
        'nl' => 'JouwEnergie',
    ],
    'nav' => [
        'en' => ['Tariffs', 'Usage', 'Contact'],
        'nl' => ['Tarieven', 'Verbruik', 'Contact'],
    ],
    'title' => [
        'en' => 'View your electricity use',
        'nl' => 'Bekijk je stroomverbruik',
    ],
    'lead' => [
        'en' => 'Share the address of your connection and we will show what it used this year.',
        'nl' => 'Deel het adres van je aansluiting, dan laten we zien wat er dit jaar verbruikt is.',
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

if ($render_full_page):
    include($_SERVER['DOCUMENT_ROOT'] . "/includes/lang.php"); ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta charset="utf-8">

	<link href="/resources/vars.css" rel="stylesheet">
	<link href="/resources/yivi.css" rel="stylesheet">
	<link href="/resources/demo-sites.css" rel="stylesheet">

	<script src="/assets/yivi.js" defer></script>
	<script src="/start_session.js" defer></script>
	<script src="./script.js" defer></script>

    <title><?php echo $title; ?> | Yivi Demos</title>
	<style>
		body {
			margin: 0;
			background: #2B1233;
		}
	</style>

	<script type="text/javascript">
		let header_text = '<?php echo $demo_strings['action'][$lang]; ?>';
		let lang = '<?php echo $lang; ?>';
		let slug = '<?php echo 'address'; ?>';
		let session_type = slug;
	</script>
</head>
<body>

<?php endif; ?>

<style>
	.address-site {
		--mock-accent: #712F87;
		--mock-on-accent: #F7E30F;
		--mock-surface: oklch(from #712F87 calc(l - .25) c h);
		--mock-on-surface: white;
	}
	.address-usage p {
		margin-block: 12px;
		font-size: 1.2em;
	}
	.address-usage :first-child {
		font-size: max(3.5vw, 2em);
	}
	.address-usage .year-at {
		text-transform: uppercase;
		font-size: 1em;
		letter-spacing: .1em;
		font-weight: 600;
	}
</style>

<figure class="demo dark address-site">

<header class="mock-header">
    <div class="mock-logo">
        <?php echo $demo_strings['organisation'][$lang]; ?>
    </div>
    <ul class="mock-nav">
        <?php foreach ($demo_strings['nav'][$lang] as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
    </ul>
</header>

<<?php echo ($render_full_page) ? 'main' : 'section'; ?> class="mock-main">
    <h<?php echo ($render_full_page) ? '1' : '2'; ?>>
        <?php echo $demo_strings['title'][$lang]; ?>
    </h<?php echo ($render_full_page) ? '1' : '2'; ?>>
    <p class="mock-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>
    <div class="yivi-form"></div>
	<div class="mock-panel address-usage" data-demo-result hidden>
		<p>
			<span class="number">942</span>
			<span class="unit">kWh</span>
		</p>
		<p class="year-at">
			<?php echo $demo_strings['year'][$lang]; ?>
		</p>
	</div>
</<?php echo ($render_full_page) ? 'main' : 'section'; ?>>

</figure>

<?php if ($render_full_page): ?>
</body>
<?php endif; ?>
