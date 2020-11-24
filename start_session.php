<?php
require_once 'config.php';

date_default_timezone_set('UTC');
$protocol = explode(':', IRMA_SERVER_URL, 2)[0];

$sigrequests = [
    'email-signature' => [
        '@context' => 'https://irma.app/ld/request/signature/v2',
        'message' => [
            'nl' => 'Hierbij geef ik expliciete toestemming aan het bedrijf X om het onderstaande e-mailadres te gebruiken om mij wekelijks een lijst met advertenties te mailen over dingen waarvan X denkt dat die voor mij interessant zijn. Deze toestemming geldt voor een jaar, tot ' . date('d/m/') . (date('Y')+1) . ', en geldt ook voor alle partnerbedrijven van X.',
            'en' =>  'I explicitly grant consent to company X to use the email address below for mailing me a weekly list of advertisements about topics that X thinks are interesting for me. This consent is valid for one year, until ' . date('d/m/') . (date('Y')+1) . ', and holds also for all partner companies of X.',
        ],
        'disclose' => [
            [
                ['pbdf.pbdf.email.email'],
                ['pbdf.sidn-pbdf.email.email'],
            ],
        ],
    ],
    'exam-signature' => [
        '@context' => 'https://irma.app/ld/request/signature/v2',
        'message' => [
            'nl' => 'Hierbij verklaar ik dat student Pietje Puk, vandaag ' . date('d / m / Y') . ', met lof geslaagd is voor het vak Grondbeginselen van de Alchemie.',
            'en' => 'Hereby I declare that today, ' . date('d / m / Y') . ', the student John Smith passed with distinction the exam of the course Foundations of Alchemy.',
        ],
        'disclose' => [
            [[
                ['type' => 'pbdf.pbdf.surfnet-2.fullname', 'value' => null],
                ['type' => 'pbdf.pbdf.surfnet-2.institute', 'value' => null],
                ['type' => 'pbdf.pbdf.surfnet-2.email', 'value' => null],
                ['type' => 'pbdf.pbdf.surfnet-2.type', 'value' => 'employee'],
            ]],
        ],
    ],
    'donation-signature' => [
        '@context' => 'https://irma.app/ld/request/signature/v2',
        'message' => [
            'nl' => 'Hierbij zeg ik toe om vandaag nog een bedrag van 10 Euro over te maken op rekening nummer NL54 INGB 0007522950 van de stichting Privacy by Design, als ondersteuning van hun nobele werkzaamheden. (Niet echt hoor)',
            'en' => 'Hereby I agree to transfer today the amount of 10 Euro to the bank account number NL54 INGB 0007522950 of the Privacy by Design foundation, in order to support their noble activities (not really).',
        ],
        'disclose' => [
            [
                ['pbdf.pbdf.idin.familyname'],
                ['pbdf.nijmegen.personalData.familyname'],
                ['pbdf.gemeente.personalData.familyname'],
                ['pbdf.pbdf.facebook.familyname'],
                ['pbdf.pbdf.linkedin.familyname'],
                ['pbdf.pbdf.twitter.fullname'],
            ],
            [['pbdf.pbdf.mobilenumber.mobilenumber']],
        ],
    ]
];

$sprequests = [
    '18plus' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.pbdf.ageLimits.over18'],
                ['pbdf.nijmegen.ageLimits.over18'],
                ['pbdf.gemeente.personalData.over18'],
            ],
        ],
    ],
    'adres' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                [
                    'pbdf.nijmegen.address.street',
                    'pbdf.nijmegen.address.houseNumber',
                    'pbdf.nijmegen.address.zipcode',
                    'pbdf.nijmegen.address.city',
                ], [
                    'pbdf.gemeente.address.street',
                    'pbdf.gemeente.address.houseNumber',
                    'pbdf.gemeente.address.zipcode',
                    'pbdf.gemeente.address.city',
                ], [
                    'pbdf.pbdf.idin.address',
                    'pbdf.pbdf.idin.zipcode',
                    'pbdf.pbdf.idin.city',
                ],
            ],
        ],
    ],
    'student' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [['pbdf.pbdf.surfnet-2.type']],
        ],
        'labels' => [
            '1' => ['en' => 'Student', 'nl' => 'Student'],
        ],
    ],
    'school' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [[[
            'pbdf.pbdf.surfnet-2.type',
            'pbdf.pbdf.surfnet-2.institute',
        ]]],
        'labels' => [
            '1' => ['en' => 'Student', 'nl' => 'Student'],
        ],
    ],
    'gmail' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.pbdf.email.domain'],
                ['pbdf.sidn-pbdf.email.domain'],
            ],
        ],
        'labels' => [
            '1' => ['en' => 'Gmail address', 'nl' => 'Gmail adres'],
        ],
    ],
    'email' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.pbdf.email.email'],
                ['pbdf.sidn-pbdf.email.email'],
            ]
        ],
    ],
    'presencecheck' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [['pbdf.pbdf.idin.familyname'], ['pbdf.pbdf.facebook.familyname']],
            [['pbdf.pbdf.surfnet-2.email', 'pbdf.pbdf.surfnet-2.id']],
        ],
    ],
    'beingalive' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [[[
            'pbdf.gemeente.personalData.initials',
            'pbdf.gemeente.personalData.familyname',
            'pbdf.gemeente.personalData.dateofbirth',
        ]]],
    ],
];

function start_session($type, $lang) {
    global $sprequests, $sigrequests, $protocol;

    if (array_key_exists($type, $sprequests))
        $sessionrequest = $sprequests[$type];
    elseif (array_key_exists($type, $sigrequests))
        $sessionrequest = get_signature_request($type, $lang);
    else
        stop();

    $jsonsr = json_encode($sessionrequest);

    $api_call = array(
        $protocol => array(
            'method' => 'POST',
            'header' => "Content-type: application/json\r\n"
                . "Content-Length: " . strlen($jsonsr) . "\r\n"
                . "Authorization: " . API_TOKEN . "\r\n",
            'content' => $jsonsr
        )
    );

    $resp = file_get_contents(IRMA_SERVER_URL . '/session', false, stream_context_create($api_call));
    if (! $resp) {
        error();
    }
    return $resp;
}

function get_signature_request($type, $lang) {
    global $sigrequests;
    $request = $sigrequests[$type];

    // Signature requests do not support translatable strings, use chosen language
    $request['message'] = $sigrequests[$type]['message'][$lang];

    return $request;
}

function error() {
    http_response_code(500);
    echo 'Internal server error';
    exit();
}

function stop() {
    http_response_code(400);
    echo 'Invalid request';
    exit();
}

if (!isset($_GET['type']) || !isset($_GET['lang']))
    stop();

echo start_session($_GET['type'], $_GET['lang']);
