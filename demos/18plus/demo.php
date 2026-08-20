<?php

$demo_strings = [
	'organisation' => ['en' => 'Pixel Pit', 'nl' => 'Pixel Pit'],
	'nav' => [
		'en' => ['Store', 'Library', 'Community'],
		'nl' => ['Winkel', 'Bibliotheek', 'Community'],
	],
	'game' => ['en' => 'Crimson Harbour VI', 'nl' => 'Crimson Harbour VI'],
	'rating' => ['en' => 'Rated 18+', 'nl' => 'Vanaf 18 jaar'],
	'title' => [
		'en' => 'Confirm your age to continue',
		'nl' => 'Bevestig je leeftijd om verder te gaan',
	],
	'lead' => [
		'en' => 'This title is rated 18+. Show that you are old enough and the store page opens.',
		'nl' => 'Deze titel is vanaf 18 jaar. Laat zien dat je oud genoeg bent en de winkelpagina gaat open.',
	],
	'price' => ['en' => '&euro;59.99', 'nl' => '&euro;59,99'],
	'buy' => ['en' => 'Add to basket', 'nl' => 'In winkelmandje'],
];
?>

<style>
	.age-site {
		--mock-accent: #2A1B4A;
		--mock-on-accent: #FFC145;
		--mock-surface: #191029;
		--mock-on-surface: #F4F1FA;
	}
	.age-cover {
		display: flex;
		gap: calc(1em + 1vw);
		align-items: center;
		flex-wrap: wrap;
		margin-block-end: calc(1em + 1vw);
	}
	.age-art {
		width: 8em;
		aspect-ratio: 3 / 4;
		border-radius: 8px;
		flex-shrink: 0;
		background:
			radial-gradient(circle at 30% 25%, #FFC145 0 12%, transparent 12%),
			linear-gradient(150deg, #6E2B6B 0%, #2A1B4A 55%, #12203F 100%);
		box-shadow: 0 .3em .8em rgba(0, 0, 0, .45);
	}
	.age-badge {
		display: inline-block;
		padding: .2em .6em;
		border: 2px solid var(--mock-on-accent);
		border-radius: 4px;
		color: var(--mock-on-accent);
		font-weight: 700;
		font-size: .85em;
	}
	.age-title {
		font-size: max(2vw, 1.3em);
		font-weight: 700;
		margin-block: .4em;
	}
</style>

<figure class="demo dark age-site">

<header class="mock-header">
	<div class="mock-logo"><?php echo $demo_strings['organisation'][$lang]; ?></div>
	<ul class="mock-nav">
		<?php foreach ($demo_strings['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="mock-main">
	<div class="age-cover">
		<div class="age-art" role="presentation"></div>
		<div>
			<span class="age-badge"><?php echo $demo_strings['rating'][$lang]; ?></span>
			<p class="age-title"><?php echo $demo_strings['game'][$lang]; ?></p>
			<p class="mock-price"><?php echo $demo_strings['price'][$lang]; ?></p>
		</div>
	</div>

	<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
	<p class="mock-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>

	<div class="yivi-form"></div>
	<div class="mock-panel" data-demo-result hidden>
		<p class="age-result"></p>
		<p data-demo-result hidden>
			<button type="button"><?php echo $demo_strings['buy'][$lang]; ?></button>
		</p>
	</div>
</section>

</figure>
