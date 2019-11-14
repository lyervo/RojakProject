<?php

    include "../model/db_connect.php";
    if(isset($_SESSION['log_user_id']))
    {
        echo $_SESSION['user_id'];
        echo 'logged in';
    }else
    {
        echo -1;
    }