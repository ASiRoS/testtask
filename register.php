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

function add_user($db, $user) {
    if(in_array('', $user)) {
        throw new Exception('One or more fields are empty.');
    }
    $stmt = mysqli_prepare($db, 'INSERT INTO users(login, email, password, avatar) VALUES (?, ?, ?, ?)');
    if(!empty($_FILES['avatar'])) {
        $image_name = image_upload($_FILES['avatar']);
    } else {
        $image_name = '';
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $user['login'], $user['email'], $user['password'], $image_name);
    $is_success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $is_success;
}
