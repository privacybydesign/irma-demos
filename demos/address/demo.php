<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'organisation' => [
        'en' => 'YourEnergy',
        'nl' => 'JouwEnergie',
    ],
    'title' => [
        'en' => 'View your electricity use',
        'nl' => 'Bekijk je stroomverbruik',
    ],
	'year' => [
        'en' => 'This year at',
		'nl' => 'Dit jaar op',
	],
    'action' => [
		'en' => 'Share your address',
		'nl' => 'Deel je adres',
    ]
];

if ($render_full_page):
    include($_SERVER['DOCUMENT_ROOT'] . "/includes/lang.php"); ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta charset="utf-8">

	<link href="/resources/vars.css" rel="stylesheet">
	<link href="/resources/yivi.css" rel="stylesheet">

	<script src="/assets/yivi.js" defer></script>
	<script src="/start_session.js" defer></script>
	<script src="./script.js" defer></script>

    <title><?php echo $title; ?> | Yivi Demos</title>
	<style>
		body {
			margin: 0;
            background: oklch(from var(--accent) calc(l - .25) c h);
            --accent: #712F87;
			color-scheme: dark;
		}

		.address-main {
			margin: 2vw auto;
			max-width: 60em;
		}
	</style>

	<script type="text/javascript">
		let header_text = '<?php echo $demo_strings['action'][$lang]; ?>';
		let lang = '<?php echo $lang; ?>';
		let slug = '<?php echo 'address'; ?>';
	</script>
</head>
<body>

<?php endif; ?>

<style>
    .address-figure {
        font-family: system-ui, sans-serif;
		margin: 0;
		color-scheme: dark;
        --accent: #712F87;
        --secondary: #F7E30F;
        --link: var(--accent);
        --link-hover: oklch(from var(--accent) calc(l + .1) c h);

        div.yivi-web-form {
            margin: 0;
			width: 100%;
			/*--yivi-text: white;*/
        }

        .yivi-web-header p {
            color: white !important;
        }

        .yivi-web-button-secondary {
			border-color: oklch(from white l c h / calc(alpha - .2));

			&:hover {
				color: white;
				background: oklch(from white l c h / calc(alpha - .9));
			}
		}

		.yivi-web-forbidden-animation {
			background: white;
			box-shadow: 0 0 0 8px white;
			border-radius: 50%;
			padding: 1em;
			margin-block-end: 1em;
		}

		.yivi-web-button-tertiary {
			color: white;
		}
    }
    .address-header {
        background: var(--accent);
        color: var(--secondary);
        padding: 1em 5vw;
    }
    .address-logo {
        font-weight: bold;
        font-size: 1.4em;
    }
    .address-main {
        padding: 2vw 5vw 5vw;
        background: oklch(from var(--accent) calc(l - .25) c h);
        color: white;

        h1,
		h2 {
            font-size: max(2.5vw, 1.5em);
			text-wrap: balance;
        }
    }
	.address-usage {
        padding: calc(1em + .5vw) calc(1.5em + 1vw);
        background: oklch(from white l c h / calc(alpha - .8));
        border-radius: 12px;

		p {
			margin-block: 12px;
			font-size: 1.2em;
		}

		:first-child {
            font-size: max(3.5vw, 2em);
        }

        .number {
            font-size: 1.2em;
            font-weight: 900;
        }

		.year-at {
            text-transform: uppercase;
            font-size: 1em;
            letter-spacing: .1em;
            font-weight: 600;
		}
    }
	figure + p {
		padding: 1em;
		background: orange;
	}
</style>

<figure class="address-figure demo">

<header class="address-header">
    <div class="address-logo">
        <?php echo $demo_strings['organisation'][$lang]; ?>
    </div>
</header>

<<?php echo ($render_full_page) ? 'main' : 'section'; ?> class="address-main">
    <h<?php echo ($render_full_page) ? '1' : '2'; ?>>
        <?php echo $demo_strings['title'][$lang]; ?>
    </h<?php echo ($render_full_page) ? '1' : '2'; ?>>
    <div id="yivi-web-form"></div>
	<div class="address-usage" hidden>
		<p>
			<span class="number">942</span>
			<span class="unit">kWh</span>
		</p>
		<p class="year-at">
			<?php echo $demo_strings['year'][$lang]; ?>
		</p>
	</div>
</<?php echo ($render_full_page) ? 'main' : 'section'; ?>>

</figure>

<?php if ($render_full_page): ?>
</body>
<?php endif; ?>