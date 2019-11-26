<?php

    include "../model/db_connect.php";
    require_once 'recipe_db.php';
    
    $user_id = $_REQUEST['user_id'];
    
    $result = getRecipeByAuthor($user_id);
    
    
    if(empty($result))
    {
        echo "You don't have any recipe yet";
    }else
    {
        $response = "<table><tr><th>Recipe Name</th><th></th><th></th><tr>";
        foreach($result as $res)
        {
            $response = $response.print_my_recipe($res);
        }
        $response = $response."</table>";
        echo $response;
        
    }
    