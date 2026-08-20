<?php
$demo_page_strings = [
	'try' => [
		'en' => 'Try it out',
		'nl' => 'Probeer het'
	],
	'with_yivi' => [
		'en' => 'with Yivi',
		'nl' => 'met Yivi'
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
	'reload' => [
		'en' => 'Reload',
		'nl' => 'Herlaad'
	],
	'sidenotes' => [
		'en' => 'Sidenotes',
		'nl' => 'Opmerkingen'
	],
	'more' => [
		'en' => 'See it in use',
		'nl' => 'In de praktijk'
	],
	'pick' => [
		'en' => 'Pick an example',
		'nl' => 'Kies een voorbeeld'
	],
];

// A demo either has one action or several, keyed by session type. A single
// action takes its type from the slug unless $content['session'] says otherwise.
// The developer details render a request per type.
$session_type = $content['session'] ?? $slug;
$session_types = empty($content['actions']) ? [$session_type] : array_keys($content['actions']);
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
		<ul role="list">
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
			$last_source = sizeof($content['data']['sources']) - 1;
			foreach($content['data']['sources'] as $key => $source) {
				// Only join with "or" when there is something to join.
				if($key === $last_source && $last_source > 0) {
					echo $demo_page_strings['or'][$lang];
				}
				if(!empty($source['url'])) {
					echo '<a href="' . $source['url'] . '" target="_blank">';
				}
				echo $source['label'];
				if(!empty($source['url'])) echo "</a>";
				if($key === $last_source) echo '.'; else echo ', ';
			} ?>
		</p>
	</div>
</aside>

<?php if (!empty($content['actions'])): ?>
<div class="demo-actions">
	<h2><?php echo $demo_page_strings['pick'][$lang]; ?></h2>
	<p>
		<?php foreach ($content['actions'] as $type => $label): ?>
			<button type="button" aria-pressed="false" data-session="<?php echo htmlspecialchars($type, ENT_QUOTES); ?>">
				<?php echo $label; ?>
			</button>
		<?php endforeach; ?>
	</p>
</div>
<?php endif; ?>

<?php // A demo whose actions each have their own pretend website keeps the square
      // out of the way until the visitor has picked one. ?>
<div class="demo-container"<?php if (!empty($content['choose_first'])) echo ' hidden'; ?>>
	<script type="text/javascript">
		let header_text = <?php echo json_encode($content['action'] ?? ''); ?>;
		let demo_actions = <?php echo json_encode($content['actions'] ?? [], JSON_FORCE_OBJECT); ?>;
		let lang = <?php echo json_encode($lang); ?>;
		let slug = <?php echo json_encode($slug); ?>;
		let session_type = <?php echo json_encode($session_type); ?>;
	</script>

	<p class="info">
		<?php echo $demo_page_strings['no_info'][$lang]; ?>
		<button id="reload" class="small">
			<?php echo $demo_page_strings['reload'][$lang]; ?>
		</button>
	</p>

	<?php
	if (file_exists('demo.php')) {
		include 'demo.php';
	}
	else {
		echo '<div class="yivi-form"></div>';
	}
	?>

	<script>
		(() => {
			document.getElementById('reload').addEventListener('click', reloadPage);

			async function reloadPage() {
				window.location.reload();
			}
		})();
	</script>
</div>

<?php if (!empty($content['more'])): ?>
<section class="more-demos">
	<h2><?php echo $demo_page_strings['more'][$lang]; ?></h2>
	<p><?php echo $content['more']['description']; ?></p>
	<p>
		<?php foreach ($content['more']['links'] as $link): ?>
			<a class="button" href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['label']; ?></a>
		<?php endforeach; ?>
	</p>
</section>
<?php endif; ?>

<aside>
	<details>
		<summary>
			<?php echo $demo_page_strings['sidenotes'][$lang]; ?>
		</summary>
		<?php foreach ((array) $content['sidenotes'] as $note): ?>
			<p><?php echo $note; ?></p>
		<?php endforeach; ?>
	</details>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/developer-details.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/yivi-details.php'); ?>
</aside>
