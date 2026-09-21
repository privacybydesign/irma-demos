<?php

$demo_strings = [
	'organisation' => [
		'en' => 'Demo Airline',
		'nl' => 'Demo Airline',
	],
	'url' => [
		'en' => 'boarding-pass.yivi.app',
		'nl' => 'boarding-pass.yivi.app',
	],
	'title' => [
		'en' => 'Flight check-in',
		'nl' => 'Check-in voor je vlucht',
	],
	'note' => [
		'en' => 'This demo runs on its own site. The button below takes you there to check in.',
		'nl' => 'Deze demo draait op een eigen site. De knop hieronder brengt je daarnaartoe om in te checken.',
	],
	'action' => [
		'en' => 'Check in with Yivi',
		'nl' => 'Check in met Yivi',
	],
];
?>

<style>
	body {
		--accent: #0b5fa5;
		--secondary: #ffffff;
	}
</style>

<figure class="demo-figure demo">
	<div class="demo-browser-bar" aria-hidden="true">
		<span class="demo-browser-dots"><i></i><i></i><i></i></span>
		<span class="demo-browser-url"><?php echo htmlspecialchars($demo_strings['url'][$lang], ENT_QUOTES); ?></span>
	</div>

	<header class="demo-header">
		<div class="demo-logo">
			<?php echo $demo_strings['organisation'][$lang]; ?>
		</div>
	</header>

	<section class="demo-main">
		<h2><?php echo $demo_strings['title'][$lang]; ?></h2>
		<p><?php echo $demo_strings['note'][$lang]; ?></p>
		<p>
			<a class="custom-button" href="https://boarding-pass.yivi.app" target="_blank">
				<?php echo $demo_strings['action'][$lang]; ?>
			</a>
		</p>
	</section>
</figure>
