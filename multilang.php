<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['language'])) {
        change_language($_POST['language']);
    }
}

function change_language($language) {
    if(in_array($language, get_existing_languages())) {
        $_SESSION['language'] = $language;
    }
}

function get_current_language() {
    $existing_languages = get_existing_languages();
    $default_language = $existing_languages[0];
    $current_language = $default_language;
    if(isset($_SESSION['language']) && in_array($_SESSION['language'], $existing_languages)) {
        $current_language = $_SESSION['language'];
    }
    return $current_language;
}

function get_existing_languages() {
    return [
        'ru',
        'en'
    ];
}

$translation = require_once 'language/'.get_current_language().'.php';

function get_translate($code) {
    global $translation;
    return $translation[$code] ?? '';
}

function get_translated_error($code) {
    return get_translate('error_'.$code);
}
