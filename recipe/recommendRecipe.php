<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    require "../user/user_db.php";
    

    $user_id = $_REQUEST["user_id"];
    
    $resultA = getUserFrequentTags($user_id);
    
    
    if(empty($resultA))
    {
        
        $resultA = getRandomTags(3);
    }
    
    
    $randIndex = array_rand($resultA);
    
   
    
    $result = getRecipeWithTag(getTagNameById($resultA[$randIndex]['tag_id']));
    
    while(empty($result))
    {
        if(empty($resultA))
        {

            $resultA = getRandomTags(3);
        }


        $randIndex = array_rand($resultA);



        $result = getRecipeWithTag(getTagNameById($resultA[$randIndex]['tag_id']));
    }

    
    $response = "<h4 id='recom'>Recommending: ". getTagNameById($resultA[$randIndex]['tag_id'])."</h4>";
    
    foreach ($result as $res)
    {
        $response = $response.printRecipe($res);
    }
    
    echo $response;
    
