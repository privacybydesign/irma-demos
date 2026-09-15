<?php

$render_full_page = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);

$demo_strings = [
    'slug' => 'exam',
    'organisation' => [
        'en' => 'Waalstad University',
        'nl' => 'Universiteit Waalstad',
    ],
    'url' => [
        'en' => 'waalstad-university.example/exams/check-in',
        'nl' => 'universiteit-waalstad.example/tentamens/inchecken',
    ],
    'title' => [
        'en' => 'Check in for your exam',
        'nl' => 'Check in voor je tentamen',
    ],
    'exam' => [
        'en' => 'Foundations of Computer Science',
        'nl' => 'Grondslagen van de Informatica',
    ],
    'checks_title' => [
        'en' => 'Check-in',
        'nl' => 'Controle bij binnenkomst',
    ],
    'check_student' => [
        'en' => 'You are registered as a student',
        'nl' => 'Je bent geregistreerd als student',
    ],
    'check_institute' => [
        'en' => 'Your registration is at <strong id="institute"></strong>',
        'nl' => 'Je registratie is bij <strong id="institute"></strong>',
    ],
    'check_enrolled' => [
        'en' => 'Student number <strong id="studentnumber"></strong> is enrolled for this exam',
        'nl' => 'Studentnummer <strong id="studentnumber"></strong> is ingeschreven voor dit tentamen',
    ],
    'room' => [
        'en' => 'Room',
        'nl' => 'Zaal',
    ],
    'seat' => [
        'en' => 'Seat',
        'nl' => 'Plaats',
    ],
    'starts' => [
        'en' => 'Starts',
        'nl' => 'Aanvang',
    ],
    'success' => [
        'en' => '✅ Welcome, <strong id="name"></strong>. Take your seat, the exam paper is on the desk. Good luck!',
        'nl' => '✅ Welkom, <strong id="name"></strong>. Neem plaats, het tentamen ligt klaar op je tafel. Succes!',
    ],
    'error' => [
        'en' => '❌ We can’t admit you automatically. Please report to the invigilator at the desk with your student card.',
        'nl' => '❌ We kunnen je niet automatisch toelaten. Meld je met je collegekaart bij de surveillant aan de balie.',
    ],
    'action' => [
        'en' => 'Show your student registration',
        'nl' => 'Toon je studentregistratie',
    ],
];

include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-head.php"); ?>

    <style>
        body {
            --accent: #1f3f7a;
            --secondary: #ffffff;
        }

        .ticket {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5em 3em;
            padding: 1em 1.25em;
            margin-block: 1em;
            border-radius: 8px;
            background: var(--secondary);
            color: var(--accent);

            h3 {
                flex-basis: 100%;
                margin: 0;
                font-size: 1.3em;
            }

            dl {
                margin: 0;
            }

            dt {
                font-size: .8em;
                text-transform: uppercase;
                letter-spacing: .1em;
                opacity: .7;
            }

            dd {
                margin: 0;
                font-size: 1.6em;
                font-weight: bold;
            }
        }
    </style>

    <div class="result" hidden>
        <h2 class="checks-title"><?php echo $demo_strings['checks_title'][$lang]; ?></h2>
        <ul class="checks" role="list">
            <li id="check-student"><span><?php echo $demo_strings['check_student'][$lang]; ?></span></li>
            <li id="check-institute"><span><?php echo $demo_strings['check_institute'][$lang]; ?></span></li>
            <li id="check-enrolled"><span><?php echo $demo_strings['check_enrolled'][$lang]; ?></span></li>
        </ul>
        <div class="success" hidden>
            <div class="ticket">
                <h3><?php echo $demo_strings['exam'][$lang]; ?></h3>
                <dl>
                    <dt><?php echo $demo_strings['room'][$lang]; ?></dt>
                    <dd>CC 2.011</dd>
                </dl>
                <dl>
                    <dt><?php echo $demo_strings['seat'][$lang]; ?></dt>
                    <dd id="seat"></dd>
                </dl>
                <dl>
                    <dt><?php echo $demo_strings['starts'][$lang]; ?></dt>
                    <dd>12:30</dd>
                </dl>
            </div>
            <p><?php echo $demo_strings['success'][$lang]; ?></p>
        </div>
        <p class="error" hidden>
            <?php echo $demo_strings['error'][$lang]; ?>
        </p>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/demo-foot.php"); ?>
