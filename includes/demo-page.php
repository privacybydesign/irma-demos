<?php
$demo_page_strings = [
	'try' => [
		'en' => 'Try it out',
		'nl' => 'Probeer het'
	],
	'with_yivi' => [
		'en' => 'with Yivi',
		'nl' => 'Met Yivi'
	],
	'benefits' => [
		'en' => 'Benefits',
		'nl' => 'Voordelen'
	],
	'cards' => [
		'en' => 'Used wallet card(s)',
		'nl' => 'Gebruikte wallet-kaartjes'
	],
	'source' => [
		'en' => ' can come from: ',
		'nl' => ' kun je inladen van: '
	],
	'or' => [
		'en' => 'or ',
		'nl' => 'of '
	],
	'no_info' => [
		'en' => 'This is a demo, no information is stored',
		'nl' => 'Dit is een demo, we slaan geen informatie op'
	],
	'sidenotes' => [
		'en' => 'Sidenotes',
		'nl' => 'Opmerkingen'
	],
];
?>

<header>
	<p class="pre-heading">
		<?php echo $demo_page_strings['try'][$lang]; ?>
	</p>
	<h1>
		<?php echo $title; ?>
		<?php echo $demo_page_strings['with_yivi'][$lang]; ?>
	</h1>
	<p class="intro"><?php echo $content['intro']; ?></p>
</header>

<aside class="summary">
	<div class="benefits block">
		<h2><?php echo $demo_page_strings['benefits'][$lang]; ?></h2>
		<ul>
			<?php foreach($content['benefits'] as $benefit): ?>
				<li><?php echo $benefit; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="data block">
		<h2><?php echo $demo_page_strings['cards'][$lang]; ?></h2>
		<p>
			<?php
			echo $content['data']['description'];
			echo $demo_page_strings['source'][$lang];
			foreach($content['data']['sources'] as $key => $source) {
				if($key === sizeof($content['data']['sources']) - 1) {
					echo $demo_page_strings['or'][$lang];
				}
				if(!empty($source['url'])) {
					echo '<a href="' . $source['url'] . '">';
				}
				echo $source['label'];
				if(!empty($source['url'])) echo "</a>";
				if($key === sizeof($content['data']['sources']) - 1) echo '.'; else echo ', ';
			} ?>
		</p>
	</div>
</aside>

<div class="demo-container">
	<script type="text/javascript">
		let header_text = '<?php echo $content['action']; ?>';
		let lang = '<?php echo $lang; ?>';
		let slug = '<?php echo $slug; ?>';
	</script>

	<p class="info">
		<?php echo $demo_page_strings['no_info'][$lang]; ?>
	</p>

	<?php
	if (file_exists('demo.php')) {
		include 'demo.php';
	}
	else {
		echo '<div id="yivi-web-form"></div>';
	}
	?>
</div>

<aside>
	<details>
		<summary>
			<?php echo $demo_page_strings['sidenotes'][$lang]; ?>
		</summary>
		<p>
			<?php echo $content['sidenotes']; ?>
		</p>
	</details>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/developer-details.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/yivi-details.php'); ?>
</aside>
