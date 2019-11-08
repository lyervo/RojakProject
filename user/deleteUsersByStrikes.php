<?php

    include '../model/db_connect.php';
    require "user_db.php";
    
    $strikes = $_REQUEST['strikes'];
    
    $count = getUserCountByStrikes($strikes);
    
    deleteUsersByStrikes($strikes);
    
    echo $count." users deleted.";
