<?php

    include "../model/db_connect.php";
    require "like_db.php";
    
    
    
    $user_id = $_REQUEST['user_id'];
    $recipe_id = $_REQUEST['recipe_id'];
    $response = getLike($recipe_id, $user_id);
    
    
    
    if(!is_numeric($user_id))
    {
        echo -1;
    }else
    {
    
        if(empty($response))
        {
            echo -1;
        }else
        {
            echo 1;
        }
    }