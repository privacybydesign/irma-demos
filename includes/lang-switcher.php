<?php
if ($lang === 'en') {
    $lang_label = 'NL';
    $lang_slug = 'nl';
} else {
    $lang_label = 'EN';
    $lang_slug = 'en';
}

$query = [];
parse_str((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);
$query['lang'] = $lang_slug;
$lang_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '?' . http_build_query($query);
?>
<a href="<?php echo htmlspecialchars($lang_url, ENT_QUOTES); ?>">
    <?php echo $lang_label; ?>
</a>