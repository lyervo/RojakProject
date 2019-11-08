<?php

    include "../db_connect.php";

    require "user_db.php";
    echo "reeeeeeeeeeeeeee";
    
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $email = $_REQUEST["email"];
    $gender = $_REQUEST["gender"];
    
    create_user($username,$password,$email,$gender);
    
    $response = "User created succesfully."
    
?>