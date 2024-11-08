<?php

define('IRMA_SERVER_URL', getenv('IRMA_SERVER_URL') ?: 'http://localhost:8088');
define('API_TOKEN', getenv('IRMA_SERVER_URL') ?: 'http://localhost:8088');
define('DEMO', false);
define('JWT_ENABLED', true);

if (DEMO) {
    define('ISSUER', 'irma-demo');
    define('BASE_URL', 'http://localhost');
    define('IRMATUBE_NEXT_SESSION_URL', BASE_URL . '/nl/get_session_request.php');
    define('IRMATUBE_CREDENTIAL', 'irma-demo.IRMATube.member');
} else {
    define('ISSUER', 'pbdf');
    define('BASE_URL', 'https://privacybydesign.foundation');
    define('IRMATUBE_NEXT_SESSION_URL', BASE_URL . '/demo/get_session_request.php');
    define('IRMATUBE_CREDENTIAL', 'pbdf.pbdf.irmatube');
}

if (JWT_ENABLED) {
    define('IRMA_SERVER_PUBLICKEY', __DIR__ . '/../data/pk.pem');
}