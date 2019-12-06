<?php

    include "../model/db_connect.php";
    require_once 'recipe_db.php';
    
    
    
    $result = getRecipeByAuthor($user['user_id']);
    
    
    if(empty($result))
    {
        echo "You don't have any recipe yet";
    }else
        
    {
        //$response = "<br><br><br><p>Your recipes</p><table><tr><th>Recipe Name</th><th></th><th></th><tr>";
        $response = "<br>";
        
            foreach($result as $res)
            {
                $response = $response.print_my_recipe($res);

            }
        
        echo $response;
        
    }
    