<?php

function connect(){
    $server   = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'testtask';
    $db = mysqli_connect($server, $username, $password, $database);

    return $db;
}
