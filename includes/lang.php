<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/demos.php');
if (isset($_GET['lang']) && $_GET['lang'] === "nl") {
    $lang = "nl";
} else {
    $lang = "en";
}
$slugs = array_filter(explode("/", $_SERVER["REQUEST_URI"]));
$slug = end($slugs);
if (empty($slug)) $slug = "home";
$title = $demos[$slug];
