<?php
require_once 'db.php';
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
        $errors[] = 'Entered email is not correct';
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

function check_login($login) {
    return (preg_match("/^[a-zA-Z1-9]*$/", $login));

}

function login_exists($db, $login) {
    $query = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");
    return (mysqli_num_rows($query) > 0);
}

function check_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function email_exists($db, $email) {
    $query = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
    return (mysqli_num_rows($query) > 0);
}

function check_password($password) {
    return strlen($password) >= 6;
}

function password_confirm($password, $confirm_password)  {
    return $password === $confirm_password;
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
