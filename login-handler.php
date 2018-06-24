<?php
require 'helpers.php';
require 'db.php';
require 'session.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data is recevied login or email
    $data = $_POST['data'] ?? '';
    $password = $_POST['password'];
    $user = get_user_by_login_or_email($data);
    if($user === null || $user['password'] !== $password) {
        $errors[] = 'Login or password is incorrect';
    } else {
        $_SESSION['login'] = $user['login'];
    }
    header('Location: login.php');
    die;
}
