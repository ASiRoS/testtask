<?php

session_start();

function is_logged_in() {
    return isset($_SESSION['login']);
}

function get_login() {
    return $_SESSION['login'];
}

function has_errors() {
    return isset($_SESSION['errors']) && !empty($_SESSION['errors']);
}
// If it has errors, than show taken message
function return_message($msg) {
    if(has_errors()) {
        return $msg;
    }
    return '';
}
