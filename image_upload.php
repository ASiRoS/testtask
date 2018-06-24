<?php

function is_image($image) {
    $check = getimagesize($image["tmp_name"]);
    return $check !== false;
}

function image_upload($image) {
    $upload_folder = "upload/";

    if(!is_image($image)) {
        $errors[] = 'File is not image';
        return false;
    }
    $image_type = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    $image_path = $upload_folder . generate_image_name($image_type);

    while(file_exists($image_path)) {
        $image_path = $upload_folder . generate_image_name($image_type);
    }

    if($image["size"] > 500000) {
        $errors[] = "Sorry, your image is too large.";
    }

    if($image_type != "jpg" && $image_type != "png" && $image_type != "jpeg"
    && $image_type != "gif") {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if(!empty($errors)) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (!move_uploaded_file($image["tmp_name"], $image_path)) {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
}

function generate_image_name($image_type) {
    $name_length = 15;
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($chars), 0, $name_length). '.' . $image_type;
}
