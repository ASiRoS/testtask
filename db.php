<?php
require 'settings.php';

function connect(){
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    return $db;
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

function add_user($db, $user) {
    if(in_array('', $user)) {
        throw new Exception('One or more fields are empty.');
    }
    $stmt = mysqli_prepare($db, 'INSERT INTO users(login, email, password, avatar) VALUES (?, ?, ?, ?)');
    if(!empty($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
        $image_name = image_upload($_FILES['avatar']);
    } else {
        $image_name = '';
    }
    $user['password'] = crypt($user['password']);
    mysqli_stmt_bind_param($stmt, 'ssss', $user['login'], $user['email'], $user['password'], $image_name);
    $is_success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $is_success;
}

function get_user_avatar_by_login($login) {
    $db = connect();
    $sql = "SELECT avatar FROM users WHERE login=?";
    $avatar = '';


    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $avatar);
    if(!mysqli_stmt_fetch($stmt)) {
        return '';
    }
    mysqli_stmt_close($stmt);
    return $avatar;
}
