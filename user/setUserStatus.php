<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
    
    $action = filter_var($_GET['action'], FILTER_SANITIZE_NUMBER_INT);
    
    $user = getUserByName($username);
    
    if(empty($user))
    {
        echo "User does not exists.";
    }else
    {
        


        if($action == 7)
        {
            setUserAdminByName($username);
            echo $username." has been set to admin.";

        }else if($action == 8)
        {
            removeUserAdminByName($username);
            echo $username." has been removed as admin.";
        }else if($action == 9)
        {

            deleteUserByName($username);
            echo $username." has been deleted.";
        }
    }