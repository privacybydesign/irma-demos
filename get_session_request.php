<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use \Firebase\JWT\JWT;

function get_session_request($contents)
{
    $parsedjson = json_decode($contents, true);
    error_log($contents);

    if (JWT_ENABLED) {
        $jwt_pk = file_get_contents(ROOT_DIR . IRMA_SERVER_PUBLICKEY);
        try {
            $decoded = JWT::decode($contents, $jwt_pk, array('RS256'));
            
            // do verification for $decoded

            $disclosed = (array) $decoded->disclosed;
            foreach ($disclosed as $con) {
                foreach ($con as $attr) {
                    if ($attr->id == "irma-demo.gemeente.personalData.fullname") {
                        $fullname = $attr->rawvalue;
                    }
                }
            }

        } catch (Exception $e) {
            error_log("JWT could not be parsed: ". $e);
            header("HTTP/1.0 403 Forbidden");
            exit;
        };
    } else {
        $fullname = $parsedjson['disclosed'][0][0]['rawvalue'];
        if (is_null($parsedjson)) {
            error_log("JSON could not be parsed.");
            header("HTTP/1.0 403 Forbidden");
            exit;
        }
    }

    $randomnum = rand(1, 9);
    for ($i = 0; $i < 10; $i++)
        $randomnum .= rand(0, 9);

    $sessionrequest = [
        '@context' => 'https://irma.app/ld/request/issuance/v2',
        'credentials' => [[
            'credential' => IRMATUBE_CREDENTIAL,
            'validity' => strtotime('+6 months'),
            'attributes' => [
                'fullname' => $fullname,
                'type' => 'premium',
                'id' => $randomnum
            ]
        ]]
    ];

    return json_encode($sessionrequest);
}

header('Access-Control-Allow-Origin: ' . BASE_URL);
echo get_session_request(file_get_contents('php://input'));
