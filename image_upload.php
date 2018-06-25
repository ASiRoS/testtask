<?php

function is_image($image) {
    if($image_type != "jpg" && $image_type != "png" && $image_type != "jpeg"
    && $image_type != "gif" && getimagesize($image["tmp_name"]) === false) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return false;
    }
    return true;
}

function image_upload($image) {
    $upload_folder = "upload/";

    if(!is_image($image)) {
        return null;
    }

    $image_type = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));

    do {
        $image_name = generate_image_name($image_type);
        $image_path = $upload_folder . $image_name;
    } while (file_exists($image_path));

    if($image["size"] > 500000) {
        $errors[] = "Sorry, your image is too large.";
    }

    if(!empty($errors)) {
        $errors[] = "Sorry, your file was not uploaded.";
    } elseif (!move_uploaded_file($image["tmp_name"], $image_path)) {
        $errors[] = "Sorry, there was an error uploading your file.";
    }
    return $image_name;
}

function generate_image_name($image_type) {
    $name_length = 15;
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($chars), 0, $name_length). '.' . $image_type;
}
