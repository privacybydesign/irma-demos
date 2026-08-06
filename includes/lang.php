<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/demos.php');
if (isset($_GET['lang']) && $_GET['lang'] === "nl") {
    $lang = "nl";
} else {
    $lang = "en";
}
$slugs = explode("/", $_SERVER["REQUEST_URI"]);
$slug = prev($slugs);
if (empty($slug)) $slug = "home";
$title = $demos[$slug][$lang];
