<?php

$demo_strings = [
	'shop' => [
		'organisation' => ['en' => 'Bitbyte', 'nl' => 'Bitbyte'],
		'nav' => [
			'en' => ['Laptops', 'Audio', 'Deals'],
			'nl' => ['Laptops', 'Audio', 'Aanbiedingen'],
		],
		'product' => ['en' => 'Aurora 14 laptop', 'nl' => 'Aurora 14 laptop'],
		'title' => ['en' => 'Student discount', 'nl' => 'Studentenkorting'],
		'lead' => [
			'en' => '15% off for students. Show us that you are one and the price changes — we learn nothing else about you.',
			'nl' => '15% korting voor studenten. Laat zien dat je er een bent en de prijs verandert — verder leren we niets over je.',
		],
		'full' => ['en' => '&euro;899', 'nl' => '&euro;899'],
		'discounted' => ['en' => '&euro;764', 'nl' => '&euro;764'],
	],
	'campus' => [
		'organisation' => ['en' => 'Campus Plus', 'nl' => 'Campus Plus'],
		'nav' => [
			'en' => ['Library', 'Software', 'Events'],
			'nl' => ['Bibliotheek', 'Software', 'Agenda'],
		],
		'title' => [
			'en' => 'Access for your institution',
			'nl' => 'Toegang voor jouw instelling',
		],
		'lead' => [
			'en' => 'Some of what we license is only for a particular institution. Share your role and institution and we will open the right shelf.',
			'nl' => 'Een deel van wat we licenti&euml;ren is alleen voor een bepaalde instelling. Deel je rol en instelling, dan zetten we de juiste plank open.',
		],
		'role' => ['en' => 'Role', 'nl' => 'Rol'],
		'institute' => ['en' => 'Institution', 'nl' => 'Instelling'],
	],
];
?>

<style>
	.shop-site {
		--site-accent: #0B6E4F;
		--site-on-accent: #E9F8F2;
	}
	.campus-site {
		--site-accent: #8A2E4D;
		--site-on-accent: #FBECF1;
	}
	.shop-product {
		display: flex;
		gap: calc(1em + 1vw);
		align-items: center;
		flex-wrap: wrap;
		margin-block-end: calc(1em + 1vw);
	}
	.shop-art {
		width: 9em;
		aspect-ratio: 3 / 2;
		border-radius: 8px;
		flex-shrink: 0;
		background:
			linear-gradient(180deg, #C9D6DE 0 72%, #7C8A94 72% 100%),
			#C9D6DE;
		box-shadow: inset 0 0 0 6px #F2F5F7, 0 .2em .6em rgba(0, 0, 0, .18);
	}
	.shop-name {
		font-weight: 700;
		font-size: 1.2em;
		margin-block: 0 .3em;
	}
</style>

<figure class="demo shop-site" data-demo="student" hidden>

<header class="site-header">
	<div class="site-logo"><?php echo $demo_strings['shop']['organisation'][$lang]; ?></div>
	<ul class="site-nav">
		<?php foreach ($demo_strings['shop']['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="site-main">
	<div class="shop-product">
		<div class="shop-art" role="presentation"></div>
		<div>
			<p class="shop-name"><?php echo $demo_strings['shop']['product'][$lang]; ?></p>
			<p class="site-price shop-price" data-demo-initial><?php echo $demo_strings['shop']['full'][$lang]; ?></p>
			<p class="site-price shop-discounted" data-demo-result hidden>
				<span class="site-strike"><?php echo $demo_strings['shop']['full'][$lang]; ?></span><?php echo $demo_strings['shop']['discounted'][$lang]; ?>
			</p>
		</div>
	</div>

	<h2><?php echo $demo_strings['shop']['title'][$lang]; ?></h2>
	<p class="site-lead"><?php echo $demo_strings['shop']['lead'][$lang]; ?></p>

	<div class="yivi-form"></div>
	<div class="site-panel shop-result" data-demo-result hidden></div>
</section>

</figure>

<figure class="demo campus-site" data-demo="school" hidden>

<header class="site-header">
	<div class="site-logo"><?php echo $demo_strings['campus']['organisation'][$lang]; ?></div>
	<ul class="site-nav">
		<?php foreach ($demo_strings['campus']['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="site-main">
	<h2><?php echo $demo_strings['campus']['title'][$lang]; ?></h2>
	<p class="site-lead"><?php echo $demo_strings['campus']['lead'][$lang]; ?></p>

	<div class="site-fields">
		<label for="campus-role"><?php echo $demo_strings['campus']['role'][$lang]; ?></label>
		<input id="campus-role" readonly>
		<label for="campus-institute"><?php echo $demo_strings['campus']['institute'][$lang]; ?></label>
		<input id="campus-institute" readonly>
	</div>

	<div class="yivi-form"></div>
	<div class="site-panel campus-result" data-demo-result hidden></div>
</section>

</figure>
