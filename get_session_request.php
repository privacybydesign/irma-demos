<?php
require_once 'config.php';

function get_session_request($contents) {
    $parsedjson = json_decode($contents, true);

    $randomnum = rand(1,9);
    for($i=0; $i<10; $i++)
    $randomnum .= rand(0,9);

    $sessionrequest = [
        '@context' => 'https://irma.app/ld/request/issuance/v2',
        'credentials' => [[
            "credential" => 'irma-demo.IRMATube.member',
            "validity" => strtotime("+6 months"),
            "attributes" => [
                "fullname" => $parsedjson['disclosed'][0][0]['rawvalue'],
                "type" => "premium",
                "id" => $randomnum
            ]
        ]]
    ];

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

header('Access-Control-Allow-Origin: ' . BASE_URL);
echo get_session_request(file_get_contents('php://input'));
