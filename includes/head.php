<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta charset="utf-8">

		<title><?php echo $title; ?> | Yivi Demos</title>

        <link href="/resources/vars.css" rel="stylesheet">
        <link href="/resources/style.css" rel="stylesheet">
        <link href="/resources/yivi.css" rel="stylesheet">
		<link href="/resources/demo.css" rel="stylesheet">

        <script src="/assets/yivi.js" defer></script>
		<script src="/start_session.js" defer></script>
		<?php if (file_exists('script.js')): ?>
        	<script src="./script.js" defer></script>
		<?php endif; ?>
    </head>