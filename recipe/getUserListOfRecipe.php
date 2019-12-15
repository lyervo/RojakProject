<?php

    include "../model/db_connect.php";
    require_once 'recipe_db.php';
    
    
    
    $result = getRecipeByAuthor($user['user_id']);
    
    
    if(empty($result))
    {
        echo "You don't have any recipe yet";
    }else
    {
        $response = "<br><br>";
        foreach($result as $res)
        {
            $response = $response.print_my_recipe($res);
        }
        $response = $response."";
        echo $response;
        
    }
    
    ?>
    