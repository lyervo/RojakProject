<?php

    include "../db_connect.php";

    require "user_db.php";
    
    
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_GET['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_GET['email'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_GET['gender'], FILTER_SANITIZE_STRING);
    
    create_user($username,$password,$email,$gender);
    
    $response = "User created succesfully."
    
?>