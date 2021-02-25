<?php
require_once 'config.php';

date_default_timezone_set('UTC');
$protocol = explode(':', IRMA_SERVER_URL, 2)[0];

$randomnum = rand(1,9);
for($i=0; $i<10; $i++)
$randomnum .= rand(0,9);

$sprequests = [
    'irmatube_premium_step2' => [
        '@context' => 'https://irma.app/ld/request/issuance/v2',
        'credentials' => [[
            "credential" => 'irma-demo.IRMATube.member',
            "validity" => strtotime("+6 months"),
            "attributes" => [
                "type" => "premium",
                "id" => $randomnum
            ]
        ]]
    ],
];

function get_session_request($type, $lang) {
    global $sprequests, $sigrequests, $protocol;

    if (array_key_exists($type, $sprequests))
        $sessionrequest = $sprequests[$type];
    else
        stop();

    return json_encode($sessionrequest);
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

header('Access-Control-Allow-Origin: *');
echo get_session_request($_GET['type'], $_GET['lang']);
