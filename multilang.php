<?php

function get_current_language() {
    $existing_languages = [
        'ru',
        'en'
    ];
    $default_language = $existing_languages[0];
    $current_language = $default_language;
    if(isset($_SESSION['language']) && in_array($_SESSION['language'], $existing_languages)) {
        $current_language = $_SESSION['language'];
    }
    return $current_language;
}

$translation = require_once 'language/'.get_current_language().'.php';
function get_translate($code) {
    global $translation;
    return $translation[$code] ?? '';
}
