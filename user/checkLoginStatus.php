<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    
    if(isset($_SESSION['log_user_id']))
    {
        $user = getUserByID($_SESSION['log_user_id']);
        if($user['admin']===1)
        {
            echo $_SESSION['log_user_id'];
        }else
        {
            echo -1;
        }
    }else
    {
        echo -1;
    }