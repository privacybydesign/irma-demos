</section>

<nav class="demo-nav">
	<h2>Demos</h2>
	<ul class="demo-list">
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/demos.php');
	foreach ($demos as $key => $labels) {
		$url = ($key === 'home') ? '/' : '/demos/' . $key . '/';
		$url .= '?lang=' . $lang; ?>
		<li <?php if ($key === $slug) echo 'class="active"'; ?>>
			<a href="<?php echo $url; ?>">
				<?php echo $labels[$lang]; ?>
			</a>
		</li>
	<?php } ?>
	</ul>
</nav>

</main>
</body>
</html>