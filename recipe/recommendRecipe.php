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
        echo "<p><b><h1>".getTagNameById($res['tag_id'])."</h1></b></p>";
        $result = getRecipeWithTag(getTagNameById($res['tag_id']));
        if(empty($result))
        {
            
        }else
        {
        
            foreach ($result as $resTag) 
            {

                $response = $response . "<p><h2><a href='?action=view_recipe&id=" . $resTag['recipe_id'] . "'>" . $resTag['recipe_name'] . "</h2></a></p><p>" . $resTag['description'] . "</p>";


            }
            echo $response;
        }
        
    }echo $response;
    