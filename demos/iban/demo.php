<?php

$demo_strings = [
	'organisation' => [
		'en' => 'FitPoint',
		'nl' => 'FitPoint',
	],
	'title' => [
		'en' => 'Set up your monthly payment',
		'nl' => 'Stel je maandelijkse betaling in',
	],
	'fullname' => [
		'en' => 'Account holder',
		'nl' => 'Rekeninghouder',
	],
	'iban' => [
		'en' => 'IBAN',
		'nl' => 'IBAN',
	],
	'bic' => [
		'en' => 'BIC',
		'nl' => 'BIC',
	],
	'confirmation' => [
		'en' => 'Your bank details are filled in. From next month we will collect €24.50 from this account.',
		'nl' => 'Je bankgegevens zijn ingevuld. Vanaf volgende maand schrijven we €24,50 van deze rekening af.',
	],
];
?>

<style>
	.iban-figure {
		font-family: system-ui, sans-serif;
		margin: 0;
		--accent: #0F5F6E;
		--secondary: #F0FBFC;
		--link: var(--accent);
		--link-hover: oklch(from var(--accent) calc(l - .1) c h);

		div.yivi-web-form {
			margin: 0;
			width: 100%;
		}
	}
	.iban-header {
		background: var(--accent);
		color: var(--secondary);
		padding: 1em 5vw;
	}
	.iban-logo {
		font-weight: bold;
		font-size: 1.4em;
	}
	.iban-main {
		padding: 2vw 5vw 5vw;
		background: white;
		color: #14181A;

		h1,
		h2 {
			font-size: max(2.5vw, 1.5em);
			text-wrap: balance;
		}
	}
	.iban-form {
		display: grid;
		grid-template-columns: minmax(8em, max-content) 1fr;
		gap: .75em 1.5em;
		align-items: center;
		max-width: 32em;
		margin-block-end: calc(1em + 1vw);

		label {
			font-weight: 600;
		}

		input {
			font: inherit;
			padding: .5em .75em;
			border: 1px solid oklch(from var(--accent) l c h / calc(alpha - .7));
			border-radius: var(--radius-small, 4px);
			background: var(--secondary);
			color: inherit;
			width: 100%;
			box-sizing: border-box;
		}
	}
	.iban-confirmation {
		max-width: 32em;
		padding: calc(.75em + .25vw) calc(1em + .5vw);
		background: var(--secondary);
		border-inline-start: 4px solid var(--accent);
		margin-block: 0;
	}
</style>

<figure class="iban-figure demo">

<header class="iban-header">
	<div class="iban-logo">
		<?php echo $demo_strings['organisation'][$lang]; ?>
	</div>
</header>

<section class="iban-main">
	<h2>
		<?php echo $demo_strings['title'][$lang]; ?>
	</h2>

	<div class="iban-form">
		<label for="iban-fullname"><?php echo $demo_strings['fullname'][$lang]; ?></label>
		<input id="iban-fullname" readonly>
		<label for="iban-number"><?php echo $demo_strings['iban'][$lang]; ?></label>
		<input id="iban-number" readonly>
		<label for="iban-bic"><?php echo $demo_strings['bic'][$lang]; ?></label>
		<input id="iban-bic" readonly>
	</div>

	<div id="yivi-web-form"></div>
	<p class="iban-confirmation" hidden>
		<?php echo $demo_strings['confirmation'][$lang]; ?>
	</p>
</section>

</figure>
