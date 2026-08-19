<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/demos.php');
if (isset($_GET['lang']) && $_GET['lang'] === "nl") {
    $lang = "nl";
} else {
    $lang = "en";
}

$url = $_SERVER['REQUEST_URI'];

// Add trailing slash to url, so relative asset paths keep resolving against the
// demo directory. Requests for a .php file are already a full path: leave those
// alone, adding a slash there would turn the script name into a directory.
if (strpos($url, "/?") === false && strpos($url, ".php") === false) {
    if (strpos($url, "?") > 0) {
        header('Location: ' . str_replace("?", "/?", $url));
        die();
    } elseif (substr($url, -1) !== "/") {
        header('Location: ' . $url . "/");
        die();
    }
}

$slugs = explode("/", parse_url($url, PHP_URL_PATH));
$slug = end($slugs);
$slug = prev($slugs);
$slug = preg_replace("/[^A-Za-z0-9 ]/", '', $slug);

if (!array_key_exists($slug, $demos)) {
    if (empty($slug)) {
        $slug = "home";
    } else {
        http_response_code(404);
        include($_SERVER['DOCUMENT_ROOT'] . '/404.php');
        die();
    }
}

$title = $demos[$slug][$lang];
