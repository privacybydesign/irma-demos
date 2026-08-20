<?php

$demo_strings = [
	'consent' => [
		'organisation' => ['en' => 'Novara', 'nl' => 'Novara'],
		'nav' => [
			'en' => ['Shop', 'Offers', 'Account'],
			'nl' => ['Winkel', 'Aanbiedingen', 'Account'],
		],
		'title' => [
			'en' => 'Weekly offers by email',
			'nl' => 'Wekelijkse aanbiedingen per e-mail',
		],
		'lead' => [
			'en' => 'Sign your consent once and we can prove, to you and to the regulator, that you gave it.',
			'nl' => 'Onderteken je toestemming één keer, dan kunnen we aan jou én aan de toezichthouder aantonen dat je die gegeven hebt.',
		],
	],
	'donation' => [
		'organisation' => ['en' => 'Privacy by Design', 'nl' => 'Privacy by Design'],
		'nav' => [
			'en' => ['About', 'Projects', 'Donate'],
			'nl' => ['Over ons', 'Projecten', 'Doneren'],
		],
		'title' => [
			'en' => 'Pledge a donation',
			'nl' => 'Zeg een donatie toe',
		],
		'lead' => [
			'en' => 'Sign a pledge of &euro;10 with your name and phone number. Nothing is actually transferred — this is a demo.',
			'nl' => 'Onderteken een toezegging van &euro;10 met je naam en telefoonnummer. Er wordt niets echt overgemaakt — dit is een demo.',
		],
	],
	'exam' => [
		'organisation' => ['en' => 'Alchemia University', 'nl' => 'Universiteit Alchemia'],
		'nav' => [
			'en' => ['Courses', 'Results', 'Staff'],
			'nl' => ['Vakken', 'Resultaten', 'Medewerkers'],
		],
		'course' => [
			'en' => 'Foundations of Alchemy',
			'nl' => 'Grondbeginselen van de Alchemie',
		],
		'title' => [
			'en' => 'Sign off the exam results',
			'nl' => 'Onderteken de tentamenuitslag',
		],
		'lead' => [
			'en' => 'A teacher signs the result sheet with their own credentials, so no wet signature has to travel through the building.',
			'nl' => 'Een docent ondertekent de cijferlijst met de eigen gegevens, zodat er geen natte handtekening meer door het gebouw hoeft.',
		],
		'student' => ['en' => 'John Smith', 'nl' => 'Pietje Puk'],
		'grade' => ['en' => 'Passed with distinction', 'nl' => 'Met lof geslaagd'],
	],
];
?>

<style>
	.consent-site {
		--mock-accent: #B3402F;
		--mock-on-accent: #FDEEEB;
	}
	.donation-site {
		--mock-accent: #1F6F5C;
		--mock-on-accent: #E9F7F3;
	}
	.exam-site {
		--mock-accent: #4B3B8F;
		--mock-on-accent: #EFECFB;
	}
	.exam-sheet {
		display: flex;
		justify-content: space-between;
		gap: 1.5em;
		flex-wrap: wrap;
		margin-block-end: calc(1em + 1vw);
		padding-block-end: .75em;
		border-block-end: 1px solid oklch(from var(--mock-on-surface) l c h / calc(alpha - .85));

		p { margin: 0; }
		.exam-course { font-weight: 700; }
		.exam-grade { color: var(--mock-accent); font-weight: 600; }
	}
</style>

<figure class="demo consent-site" data-demo="email-signature" hidden>
	<header class="mock-header">
		<div class="mock-logo"><?php echo $demo_strings['consent']['organisation'][$lang]; ?></div>
		<ul class="mock-nav">
			<?php foreach ($demo_strings['consent']['nav'][$lang] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
		</ul>
	</header>
	<section class="mock-main">
		<h2><?php echo $demo_strings['consent']['title'][$lang]; ?></h2>
		<p class="mock-lead"><?php echo $demo_strings['consent']['lead'][$lang]; ?></p>
		<div class="yivi-form"></div>
		<div class="mock-panel" data-demo-result hidden></div>
	</section>
</figure>

<figure class="demo donation-site" data-demo="donation-signature" hidden>
	<header class="mock-header">
		<div class="mock-logo"><?php echo $demo_strings['donation']['organisation'][$lang]; ?></div>
		<ul class="mock-nav">
			<?php foreach ($demo_strings['donation']['nav'][$lang] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
		</ul>
	</header>
	<section class="mock-main">
		<h2><?php echo $demo_strings['donation']['title'][$lang]; ?></h2>
		<p class="mock-lead"><?php echo $demo_strings['donation']['lead'][$lang]; ?></p>
		<div class="yivi-form"></div>
		<div class="mock-panel" data-demo-result hidden></div>
	</section>
</figure>

<figure class="demo exam-site" data-demo="exam-signature" hidden>
	<header class="mock-header">
		<div class="mock-logo"><?php echo $demo_strings['exam']['organisation'][$lang]; ?></div>
		<ul class="mock-nav">
			<?php foreach ($demo_strings['exam']['nav'][$lang] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
		</ul>
	</header>
	<section class="mock-main">
		<div class="exam-sheet">
			<div>
				<p class="exam-course"><?php echo $demo_strings['exam']['course'][$lang]; ?></p>
				<p><?php echo $demo_strings['exam']['student'][$lang]; ?></p>
			</div>
			<p class="exam-grade"><?php echo $demo_strings['exam']['grade'][$lang]; ?></p>
		</div>
		<h2><?php echo $demo_strings['exam']['title'][$lang]; ?></h2>
		<p class="mock-lead"><?php echo $demo_strings['exam']['lead'][$lang]; ?></p>
		<div class="yivi-form"></div>
		<div class="mock-panel" data-demo-result hidden></div>
	</section>
</figure>
