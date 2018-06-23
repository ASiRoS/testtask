<?php
require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connect();
    $user['login'] = $_POST['login'] ?? '';
    $user['email'] = $_POST['password'] ?? '';
    $user['password'] = $_POST['password'];
    $confirm_password = $_POST['confirm_password'] ?? '';
    if(in_array('', $user)) {
        throw new Exception('One or more fields are empty.');
    }
    $stmt = mysqli_prepare($db, 'INSERT INTO users(login, email, password) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $user['login'], $user['email'], $user['password']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);
}
