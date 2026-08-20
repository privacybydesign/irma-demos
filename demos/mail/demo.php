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
		--mock-accent: #3B3B8F;
		--mock-on-accent: #EEEEFB;
	}
</style>

<figure class="demo mail-site">

<header class="mock-header">
	<div class="mock-logo"><?php echo $demo_strings['organisation'][$lang]; ?></div>
	<ul class="mock-nav">
		<?php foreach ($demo_strings['nav'][$lang] as $item): ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
</header>

<section class="mock-main">
	<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
	<p class="mock-lead"><?php echo $demo_strings['lead'][$lang]; ?></p>

	<div class="mock-fields">
		<label for="mail-address"><?php echo $demo_strings['address'][$lang]; ?></label>
		<input id="mail-address" readonly>
	</div>

	<div class="yivi-form"></div>
	<div class="mock-panel mail-result" data-demo-result hidden></div>
</section>

</figure>
