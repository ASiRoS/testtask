<?php
require_once 'db.php';
require_once 'helpers.php';
require_once 'image_upload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connect();

    $errors = [];

    $user['login'] = $_POST['login'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'];
    $confirm_password = $_POST['confirm_password'] ?? '';
    if(!check_login($user['login'])) {
        $errors[] = 'Login must contain only letters A-Z and numbers.';
    }
    if(!check_email($user['email'])) {
        $errors[] = 'Invalid email address';
    }

    if(!check_password($user['password'])) {
        $errors[] = 'Password must contain at least 6 characters';
    } elseif(!password_confirm($user['password'], $confirm_password)) {
        $errors[] = 'Passwords doesn\'t match';
    }

    if(!empty($errors)) {
        print_r($errors);
    } else {
        if(login_exists($db, $user['login'])) {
            $errors[] = 'This login already exists.';
        }
        if(email_exists($db, $user['email'])) {
            $errors[] = 'This email already exists';
        }
        if(!empty($errors)) {
            print_r($errors);
        } else {
            add_user($db, $user);
        }
    }

    mysqli_close($db);
}
