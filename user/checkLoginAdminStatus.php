<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    
    if(isset($_SESSION['user_id']))
    {
        $user = getUserByID($_SESSION['user_id']);
        
        if($user["admin"] == 1)
        {
            echo $user['user_id'];
        }else
        {
            echo -1;
        }
        
    }else
    {
        echo -1;
    }
    
    ?>