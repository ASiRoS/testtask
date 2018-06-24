<?php

function check_login($login) {
    return (preg_match("/^[a-zA-Z1-9]*$/", $login));

}

function login_exists($db, $login) {
    $query = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");
    return (mysqli_num_rows($query) > 0);
}

function check_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function email_exists($db, $email) {
    $query = mysqli_query($db, "SELECT id FROM users WHERE email='$email'");
    return (mysqli_num_rows($query) > 0);
}

function check_password($password) {
    return strlen($password) >= 6;
}

function password_confirm($password, $confirm_password)  {
    return $password === $confirm_password;
}
