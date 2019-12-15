<?php

    include "../model/db_connect.php";
    require_once 'recipe_db.php';
    
    
    
    $result = getRecipeByAuthor($user['user_id']);
    
    
    if(empty($result))
    {
        echo "This user doesn't have any recipe yet.";
    }else
    {
        
        $response = "";
        foreach($result as $res)
        {
            $response = $response.print_my_recipe_visitor($res);
        }
        $response = $response."</table>";
        echo $response;
        
    }
    
    ?>