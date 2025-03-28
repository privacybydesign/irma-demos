<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function get_session_request()
{
    // TEST PURPOSE
    // Based on get_session_request.php
    
    $randomnum = rand(1, 9);
    for ($i = 0; $i < 10; $i++)
        $randomnum .= rand(0, 9);

    $sessionrequest = [
        '@context' => 'https://irma.app/ld/request/issuance/v2',
        'credentials' => [[
            'credential' => 'irma-demo.interpolis.login',
            'validity' => strtotime('+6 months'),
            'attributes' => [
                'identifier' => $randomnum
            ]
        ]]
    ];

    return json_encode($sessionrequest);
}

//header('Access-Control-Allow-Origin: ' . BASE_URL);
// TEMP ALLOW ALL REQUESTORS
header('Access-Control-Allow-Origin: *');

echo get_session_request();
