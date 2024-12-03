<?php
 
define('IRMA_SERVER_URL', getenv('IRMA_SERVER_URL') ?: 'http://localhost:8088');
define('API_TOKEN', getenv('API_TOKEN') ?: '');
define('DEMO', false);
define('JWT_ENABLED', getenv('JWT_ENABLED')?: false);

if (DEMO) {
    define('ISSUER', 'irma-demo');
    define('BASE_URL', 'http://localhost:8080'); 
    define('IRMATUBE_NEXT_SESSION_URL', BASE_URL . '/get_session_request.php');
    define('IRMATUBE_CREDENTIAL', 'irma-demo.IRMATube.member');
} else {
    define('ISSUER',getenv('ISSUER') ?: 'pbdf');
    define('BASE_URL', getenv('BASE_URL') ?: 'https://privacybydesign.foundation');
    define('IRMATUBE_NEXT_SESSION_URL',getenv('IRMATUBE_NEXT_SESSION_URL') ?: BASE_URL . '/get_session_request.php');
    define('IRMATUBE_CREDENTIAL',  getenv('IRMATUBE_CREDENTIAL') ?: 'pbdf.pbdf.irmatube');
}

if (JWT_ENABLED) {
    define('IRMA_SERVER_PUBLICKEY',getenv('IRMA_SERVER_PUBLICKEY') ?: __DIR__ . '/../data/pk.pem');
}