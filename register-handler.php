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
        $_SESSION['errors'] = $errors;
        redirect('register.php');
    }
    if(login_exists($db, $user['login'])) {
        $errors[] = 'This login already exists.';
    }
    if(email_exists($db, $user['email'])) {
        $errors[] = 'This email already exists';
    }
    if(empty($errors)) {
        add_user($db, $user);
    } else {
        $_SESSION['errors'] = $errors;
        redirect('register.php');
    }

    mysqli_close($db);
}
