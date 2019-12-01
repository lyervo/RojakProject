<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    require "../user/user_db.php";
    

    $user_id = $_REQUEST["user_id"];
    
    $resultA = getUserFrequentTags($user_id);
    
    
    if(empty($resultA))
    {
        $resultA = getRandomTags(3);
    } else
    {
        
        if(count($resultA)<3)
        {
            $resultB = getRandomTags(count(3-$resultA));
            $resultA = array_merge($resultA,$resultB);
        }
        
    }
    
    
    
    foreach($resultA as $res)
    {
        $response = "";
        
        $result = getRecipeWithTag(getTagNameById($res['tag_id']));
        if(empty($result))
        {
            
        }else
        {
        
            foreach ($result as $resTag) 
            {

                $response = $response . printRecipe($resTag);


            }
            echo $response;
        }
        
    }
    
    echo $response;
    