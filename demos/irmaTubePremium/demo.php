<?php

$demo_strings = [
	'organisation' => ['en' => 'YiviTube', 'nl' => 'YiviTube'],
	'nav' => [
		'en' => ['Browse', 'Trailers', 'Premium'],
		'nl' => ['Ontdek', 'Trailers', 'Premium'],
	],
	'title' => [
		'en' => 'Become a premium member',
		'nl' => 'Word premium lid',
	],
	'lead' => [
		'en' => 'Confirm once. We ask for your name, and the membership card lands in your Yivi app with that name already on it.',
		'nl' => 'Bevestig één keer. We vragen je naam, en het lidmaatschapskaartje belandt in je Yivi-app met die naam er al op.',
	],
	'perks' => [
		'en' => ['No ads, ever', 'Premium films and series', 'Works on other Yivi sites'],
		'nl' => ['Nooit reclame', 'Premium films en series', 'Werkt op andere Yivi-sites'],
	],
	'watch' => [
		'en' => 'Watch on YiviTube',
		'nl' => 'Kijk op YiviTube',
	],
];
?>

<style>
	.tube-site {
		--site-accent: #171717;
		--site-on-accent: #F5F5F5;
		--site-surface: #232323;
		--site-on-surface: #F5F5F5;
	}
	.tube-site .site-logo span {
		color: #E12747;
	}
	.tube-perks {
		list-style: none;
		padding: 0;
		margin-block: 0 calc(1em + 1vw);
		display: flex;
		gap: 1.5em;
		flex-wrap: wrap;

		li {
			margin: 0;
			display: flex;
			gap: .5em;
		}

		li:before {
			content: '✓';
			color: #E12747;
			font-weight: 700;
		}
	}
</style>

<figure class="demo dark tube-site">

<header class="site-header">
	<div class="site-logo">Yivi<span>Tube</span></div>
	<ul class="site-nav">
		<?php foreach ($demo_strings['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="site-main">
	<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
	<ul class="tube-perks">
		<?php foreach ($demo_strings['perks'][$lang] as $perk): ?>
			<li><?php echo $perk; ?></li>
		<?php endforeach; ?>
	</ul>
	<p class="site-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>

	<div class="yivi-form"></div>
	<div class="site-panel tube-result" data-demo-result hidden></div>
</section>

</figure>
