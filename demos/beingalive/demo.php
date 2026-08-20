<?php

$demo_strings = [
	'organisation' => ['en' => 'Vitalis Insurance', 'nl' => 'Vitalis Verzekeringen'],
	'nav' => [
		'en' => ['Policies', 'Payments', 'Contact'],
		'nl' => ['Polissen', 'Uitkeringen', 'Contact'],
	],
	'policy' => ['en' => 'Annuity policy', 'nl' => 'Lijfrentepolis'],
	'number' => ['en' => 'VIT-4471-092', 'nl' => 'VIT-4471-092'],
	'title' => [
		'en' => 'Your yearly proof of life',
		'nl' => 'Je jaarlijkse bewijs van in leven zijn',
	],
	'lead' => [
		'en' => 'We pay out as long as we know you are still with us. Once a year we have to ask.',
		'nl' => 'We keren uit zolang we weten dat je er nog bent. E&eacute;n keer per jaar moeten we het vragen.',
	],
	'due' => [
		'en' => 'Due this month',
		'nl' => 'Deze maand verwacht',
	],
];
?>

<style>
	.alive-site {
		--site-accent: #1F5673;
		--site-on-accent: #E8F4FA;
	}
	.alive-policy {
		display: flex;
		gap: calc(1em + 1vw);
		flex-wrap: wrap;
		margin-block-end: calc(1em + 1vw);
	}
	.alive-policy dt {
		font-size: .85em;
		text-transform: uppercase;
		letter-spacing: .08em;
		color: var(--site-muted);
	}
	.alive-policy dd {
		margin: .2em 0 0;
		font-weight: 600;
		font-size: 1.1em;
	}
	.alive-due {
		color: #A33B1F;
	}
</style>

<figure class="demo alive-site">

<header class="site-header">
	<div class="site-logo"><?php echo $demo_strings['organisation'][$lang]; ?></div>
	<ul class="site-nav">
		<?php foreach ($demo_strings['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="site-main">
	<dl class="alive-policy">
		<div>
			<dt><?php echo $demo_strings['policy'][$lang]; ?></dt>
			<dd><?php echo $demo_strings['number'][$lang]; ?></dd>
		</div>
		<div>
			<dt><?php echo $demo_strings['due'][$lang]; ?></dt>
			<dd class="alive-due"><em>Attestatio de Vita</em></dd>
		</div>
	</dl>

	<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
	<p class="site-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>

	<div class="yivi-form"></div>
	<div class="site-panel alive-result" data-demo-result hidden></div>
</section>

</figure>
