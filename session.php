<?php

session_start();

function is_logged_in() {
    return isset($_SESSION['login']);
}

function get_login() {
    return $_SESSION['login'];
}
