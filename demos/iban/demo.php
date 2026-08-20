<?php

$demo_strings = [
	'organisation' => ['en' => 'FitPoint', 'nl' => 'FitPoint'],
	'nav' => [
		'en' => ['Clubs', 'Classes', 'Membership'],
		'nl' => ['Clubs', 'Lessen', 'Lidmaatschap'],
	],
	'title' => [
		'en' => 'Set up your monthly payment',
		'nl' => 'Stel je maandelijkse betaling in',
	],
	'lead' => [
		'en' => 'Almost done. We only need the account we may collect your membership from.',
		'nl' => 'Bijna klaar. We hebben alleen nog de rekening nodig waarvan we je lidmaatschap mogen afschrijven.',
	],
	'fullname' => ['en' => 'Account holder', 'nl' => 'Rekeninghouder'],
	'iban' => ['en' => 'IBAN', 'nl' => 'IBAN'],
	'bic' => ['en' => 'BIC', 'nl' => 'BIC'],
	'confirmation' => [
		'en' => 'Your bank details are filled in. From next month we will collect &euro;24.50 from this account.',
		'nl' => 'Je bankgegevens zijn ingevuld. Vanaf volgende maand schrijven we &euro;24,50 van deze rekening af.',
	],
];
?>

<style>
	.iban-site {
		--site-accent: #0F5F6E;
		--site-on-accent: #EAFAFC;
	}
	.iban-site .site-fields {
		margin-block-end: calc(1em + 1vw);
	}
</style>

<figure class="demo iban-site">

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
		<label for="iban-fullname"><?php echo $demo_strings['fullname'][$lang]; ?></label>
		<input id="iban-fullname" readonly>
		<label for="iban-number"><?php echo $demo_strings['iban'][$lang]; ?></label>
		<input id="iban-number" readonly>
		<label for="iban-bic"><?php echo $demo_strings['bic'][$lang]; ?></label>
		<input id="iban-bic" readonly>
	</div>

	<div class="yivi-form"></div>
	<p class="site-note" data-demo-result hidden>
		<?php echo $demo_strings['confirmation'][$lang]; ?>
	</p>
</section>

</figure>
