<?php


    include "../model/db_connect.php";
    require "user_db.php";

    $user_id = $_POST['user_id'];

    if(isset($_FILES['image_file']))
    {
        
        $filePath = $_FILES['image_file']['tmp_name'];
        
        $blob = fopen($filePath, 'rb');
        
        add_user_image($user_id, $blob);
        
    }else
    {
        echo "Not valid file";
    }