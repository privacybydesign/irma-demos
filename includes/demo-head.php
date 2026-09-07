<?php if ($render_full_page) include($_SERVER['DOCUMENT_ROOT'] . "/includes/lang.php"); ?>
<?php if ($render_full_page): ?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta charset="utf-8">

    <link href="/resources/vars.css" rel="stylesheet">
    <link href="/resources/yivi.css" rel="stylesheet">
    <link href="/resources/demo.css" rel="stylesheet">

    <script src="/assets/yivi.js" defer></script>
    <script src="/start_session.js" defer></script>
    <script src="./script.js" defer></script>

    <title><?php echo $title; ?> | Yivi Demos</title>
</head>
<body class="stand-alone">

<?php endif; ?>

<script type="text/javascript">
	let header_text = <?php echo json_encode($demo_strings['action'][$lang]); ?>;
	let lang = <?php echo json_encode($lang); ?>;
	let slug = <?php echo json_encode($demo_strings['slug']); ?>;
</script>

<figure class="demo-figure demo">

    <?php if (!$render_full_page):
        // Fake browser chrome, mirroring the screenshot frame on yivi.app.
        // Falls back to a domain derived from the organisation name when a demo doesn't set one.
        $demo_url = $demo_strings['url'][$lang]
            ?? strtolower(preg_replace('/[^a-z0-9]+/i', '', $demo_strings['organisation'][$lang])) . '.example';
    ?>
    <div class="demo-browser-bar" aria-hidden="true">
        <span class="demo-browser-dots"><i></i><i></i><i></i></span>
        <span class="demo-browser-url"><?php echo htmlspecialchars($demo_url, ENT_QUOTES); ?></span>
    </div>
    <?php endif; ?>

    <header class="demo-header">
        <div class="demo-logo">
            <?php echo $demo_strings['organisation'][$lang]; ?>
        </div>
		<?php if ($render_full_page) include($_SERVER['DOCUMENT_ROOT'] . "/includes/lang-switcher.php"); ?>
    </header>

    <<?php echo ($render_full_page) ? 'main' : 'section'; ?> class="demo-main">
    <h<?php echo ($render_full_page) ? '1' : '2'; ?>>
        <?php echo $demo_strings['title'][$lang]; ?>
    </h<?php echo ($render_full_page) ? '1' : '2'; ?>>
    <div id="yivi-web-form"></div>