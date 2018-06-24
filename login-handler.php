<?php
require 'helpers.php';
require 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data is recevied login or email
    $data = $_POST['data'] ?? '';
    $password = $_POST['password'];
    $user = get_user_by_login_or_email($data);
    if($user === null || $user['password'] !== $password) {
        $errors[] = 'Login or password is incorrect';
    } else {
        session_start();
        $_SESSION['login'] = $user['login'];
    }
    header('Location: login.php');
    die;
}

// It can fetch data from db, you need to pass login or email string to $data param
function get_user_by_login_or_email($data)
{
    $db = connect();
    $sql = "SELECT login, email, password, avatar FROM users WHERE ";
    $user = [];
    // If email is passed, we will fetch data from DB, filtering by email
    // or else, we filter by login
    $sql .= (check_email($data)) ? "email=?" : "login=?";

    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $data);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,  $user['login'], $user['email'], $user['password'], $user['avatar']);
    if(!mysqli_stmt_fetch($stmt)) {
        return null;
    }
    mysqli_stmt_close($stmt);
    return $user;
}
