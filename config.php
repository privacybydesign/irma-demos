<?php

define('IRMA_SERVER_URL', 'http://localhost:8088');
define('API_TOKEN', '');
define('DEMO', false);

if (DEMO) {
    define('ISSUER', 'irma-demo');
    define('BASE_URL', 'http://localhost');
    define('IRMATUBE_NEXT_SESSION_URL', BASE_URL . '/nl/get_session_request.php');
} else {
    define('ISSUER', 'pbdf');
    define('BASE_URL', 'https://privacybydesign.foundation');
    define('IRMATUBE_NEXT_SESSION_URL', BASE_URL . '/demo/get_session_request.php');
}