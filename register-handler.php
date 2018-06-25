<?php
require_once 'bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connect();

    $errors = [];

    $user['login'] = $_POST['login'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'];
    $confirm_password = $_POST['confirm_password'] ?? '';
    if(!check_login($user['login'])) {
        $errors['login_invalid'] = true;
    }
    if(!check_email($user['email'])) {
        $errors['email_invalid'] = true;
    }

    if(!check_password($user['password'])) {
        $errors['password_length'] = true;
    }

    if(!password_confirm($user['password'], $confirm_password)) {
        $errors['password_match'] = true;
    }

    if(!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('register.php');
    }
    if(login_exists($db, $user['login'])) {
        $errors['login_exists'] = true;
    }
    if(email_exists($db, $user['email'])) {
        $errors['email_exists'] = true;
    }
    if(empty($errors)) {
        if(add_user($db, $user)) {
            $_SESSION['success_registration'] = true;
        } else {
            $_SESSION['error_went_wrong'] = true;
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
    redirect('register.php');
}
