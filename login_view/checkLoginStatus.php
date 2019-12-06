<?php

    include "../model/db_connect.php";
    
    if(isset($_SESSION['log_user_id']))
    {
        echo $_SESSION['log_user_id'];
    }else
    {
        echo -1;
    }
