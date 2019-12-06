<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    
    if(isset($_SESSION['user_id']))
    {
        
        echo $_SESSION['user_id'];
        
    }else
    {
        echo -1;
    }