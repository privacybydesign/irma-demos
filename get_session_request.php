<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function get_session_request($contents)
{
    if (JWT_ENABLED) {
        $jwt_pk = file_get_contents(IRMA_SERVER_PUBLICKEY);
        try {
            $decoded = JWT::decode($contents, new Key($jwt_pk, 'RS256'));
        } catch (Exception $e) {
            error_log("JWT could not be parsed: " . $e);
            header("HTTP/1.0 403 Forbidden");
            exit;
        };
    } else {
        $decoded = json_decode($contents, false);
        if (is_null($decoded)) {
            error_log("JSON could not be parsed.");
            header("HTTP/1.0 403 Forbidden");
            exit;
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == 'petition-signature') {
        $city = $decoded->disclosed[0][0]->rawvalue;

        $message = [
            'en' => "I sign this petition to turn the Main Square in $city into a park",
            'nl' => "Ik onderteken deze petitie om het Hoofdplein in $city in een park te veranderen",
        ];
        $sessionrequest = [
            '@context' => 'https://irma.app/ld/request/signature/v2',
            'message' => $message[$_GET['lang']],
            'disclose' => [
                [[
                    'pbdf.gemeente.personalData.initials',
                    'pbdf.gemeente.personalData.familyname',
                ]]
            ]
        ];
    } else {
        $fullname = $decoded->disclosed[0][0]->rawvalue;

        if (!$fullname) {
            $fullname = "John Doe";
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
    }

    return json_encode($sessionrequest);
}

header('Access-Control-Allow-Origin: ' . BASE_URL);
echo get_session_request(file_get_contents('php://input'));
