<?php

    include "../model/db_connect.php";
    require "user_db.php";
    
    $username = $_REQUEST['username'];
    
    $action = $_REQUEST['action'];
    
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