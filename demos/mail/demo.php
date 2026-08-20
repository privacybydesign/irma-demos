<?php

$demo_strings = [
	'organisation' => ['en' => 'Forum Nova', 'nl' => 'Forum Nova'],
	'nav' => [
		'en' => ['Boards', 'Members', 'Help'],
		'nl' => ['Onderwerpen', 'Leden', 'Help'],
	],
	'title' => [
		'en' => 'Sign in to Forum Nova',
		'nl' => 'Log in bij Forum Nova',
	],
	'lead' => [
		'en' => 'Members sign in with an email address from their wallet. No password to remember, and no confirmation mail to wait for.',
		'nl' => 'Leden loggen in met een e-mailadres uit hun wallet. Geen wachtwoord om te onthouden, en geen bevestigingsmail om op te wachten.',
	],
	'address' => ['en' => 'Email address', 'nl' => 'E-mailadres'],
];
?>

<style>
	.mail-site {
		--site-accent: #3B3B8F;
		--site-on-accent: #EEEEFB;
	}
	.mail-site .site-fields {
		margin-block-end: calc(1em + 1vw);
	}
</style>

<figure class="demo mail-site">

<header class="site-header">
	<div class="site-logo"><?php echo $demo_strings['organisation'][$lang]; ?></div>
	<ul class="site-nav">
		<?php foreach ($demo_strings['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="site-main">
	<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
	<p class="site-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>

	<div class="site-fields">
		<label for="mail-address"><?php echo $demo_strings['address'][$lang]; ?></label>
		<input id="mail-address" readonly>
	</div>

	<div class="yivi-form"></div>
	<div class="site-panel mail-result" data-demo-result hidden></div>
</section>

</figure>
