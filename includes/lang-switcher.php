<?php
$lang_url = $_SERVER['REQUEST_URI'];
$query = parse_url($lang_url, PHP_URL_QUERY);
if ($lang === 'en') {
    $lang_label = 'NL';
    $lang_slug = 'nl';
} else {
    $lang_label = 'EN';
    $lang_slug = 'en';
}
if ($query) {
    if (isset($_GET['lang']))
        $lang_url = str_replace('lang=' . $lang, 'lang=' . $lang_slug, $lang_url);
    else
        $lang_url .= "&lang=nl";
} else {
    $lang_url .= "?lang=nl";
}
?>
<a href="<?php echo $lang_url; ?>">
    <?php echo $lang_label; ?>
</a>