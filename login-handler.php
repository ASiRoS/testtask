<?php
require_once 'bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data is recevied login or email
    $data = $_POST['data'] ?? '';
    $password = $_POST['password'];
    $user = get_user_by_login_or_email($data);
    if($user === null) {
        if(crypt($user['password'], $password) !== $password)
        $errors[] = 'Login or password is incorrect';
        $_SESSION['errors'] = $errors;
        $_SESSION['entered_login'] = $user['login'];
        redirect('login.php');
    } else {
        $_SESSION['login'] = $user['login'];
    }
    redirect('login.php');
}
