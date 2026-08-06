<?php
	if (isset($_GET['lang']) && $_GET['lang'] === "nl") {
		$lang = "nl";
	} else {
		$lang = "en";
	}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta charset="utf-8">

		<title><?php echo $title[$lang]; ?></title>

        <link rel="stylesheet" href="/assets/bootstrap.min.css">
        <link href="/resources/style.css" rel="stylesheet">

        <script src="/assets/yivi.js" defer></script>
		<script src="/start_session.js" defer></script>
        <script src="messages.<?php echo $lang; ?>.js" defer></script>
        <script src="./script.js" defer></script>
    </head>