<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/demos.php');
if (isset($_GET['lang']) && $_GET['lang'] === "nl") {
    $lang = "nl";
} else {
    $lang = "en";
}
$slugs = explode("/", $_SERVER["REQUEST_URI"]);
$end = end($slugs);
$slug = prev($slugs);
$slug = preg_replace("/[^A-Za-z0-9 ]/", '', $slug);

if (!array_key_exists($slug, $demos)) {
    http_response_code(404);
    include($_SERVER['DOCUMENT_ROOT'] . '/404.php');
    die();
} elseif (empty($slug)) {
    $slug = "home";
}

$title = $demos[$slug][$lang];
