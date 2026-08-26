<?php
require_once 'config.php';

date_default_timezone_set('UTC');

$sprequests = [
    '18plus' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.gemeente.personalData.over18'],
                ['pbdf.pbdf.passport.over18'],
                ['pbdf.pbdf.drivinglicence.over18'],
                ['pbdf.pbdf.idcard.over18'],
            ],
        ],
    ],
    'address' => [
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
    'domain' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.pbdf.email.domain'],
                ['pbdf.sidn-pbdf.email.domain'],
            ],
        ],
    ],
    'mail' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                ['pbdf.pbdf.email.email'],
                ['pbdf.sidn-pbdf.email.email'],
            ]
        ],
    ],
    'iban' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [
            [
                [
                    'pbdf.pbdf.iban.fullname',
                    'pbdf.pbdf.iban.iban',
                    'pbdf.pbdf.iban.bic'
                ]
            ]
        ],
    ],
    'chained' => [
        'nextSession' => [
            'url' => IRMATUBE_NEXT_SESSION_URL
        ],
        'request' => [
            '@context' => 'https://irma.app/ld/request/disclosure/v2',
            'disclose' => [
                [
                    ['pbdf.gemeente.personalData.fullname'],
                    ['pbdf.pbdf.passport.lastName'],
                    ['pbdf.pbdf.drivinglicence.lastName'],
                    ['pbdf.pbdf.idcard.lastName'],
                    ['pbdf.pbdf.linkedin.familyname']
                ]
            ],
        ]
    ],
    'beingalive' => [
        '@context' => 'https://irma.app/ld/request/disclosure/v2',
        'disclose' => [[[
            'pbdf.gemeente.personalData.initials',
            'pbdf.gemeente.personalData.familyname',
            'pbdf.gemeente.personalData.dateofbirth',
        ]]],
    ],
    'signature' => [
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
    'petition' => [
        'nextSession' => [
            'url' => BASE_URL . '/get_session_request.php?type=petition-signature&lang=',
        ],
        'request' => [
            '@context' => 'https://irma.app/ld/request/disclosure/v2',
            'disclose' => [
                [
                    ['pbdf.nijmegen.address.city'],
                    ['pbdf.gemeente.address.city'],
                    ['pbdf.pbdf.idin.city'],
                ]
            ],
        ]
    ]
];

function start_session($type, $lang) {
    global $sprequests;

    if (array_key_exists($type, $sprequests))
        $sessionrequest = $sprequests[$type];
    else
        stop();

    if (str_contains($type, 'signature'))
        $sessionrequest['message'] = $sessionrequest['message'][$lang];

    if (str_contains($type, 'petition'))
        $sessionrequest['nextSession']['url'] .= $lang;

    $jsonsr = json_encode($sessionrequest);

    $api_call = array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-type: application/json\r\n"
                    . "Content-Length: " . strlen($jsonsr) . "\r\n"
                    . "Authorization: " . API_TOKEN . "\r\n",
        'content' => $jsonsr,
    )
);


    $resp = file_get_contents(IRMA_SERVER_URL . '/session', false, stream_context_create($api_call));
    if (! $resp) {
        error();
    }
    return $resp;
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

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {

    if (!isset($_GET['type']) || !isset($_GET['lang']))
        stop();

    // Signature requests index their message by language; keep that lookup on a
    // known key instead of whatever arrives in the query string.
    $lang = strtolower($_GET['lang']) === 'nl' ? 'nl' : 'en';

    header('Access-Control-Allow-Origin: ' . BASE_URL);
    echo start_session($_GET['type'], $lang);

}
