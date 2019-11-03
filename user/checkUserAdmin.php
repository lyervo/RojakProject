<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    $user_id = $_REQUEST['user_id'];
    
    $admin = getUserByID($user_id);
    
    echo $admin['admin'];