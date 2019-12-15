<?php
    
    include "../model/db_connect.php";
    require "recipe_db.php";

    $tagName = filter_var($_GET['tag'],FILTER_SANITIZE_STRING);
    $recipe_id = filter_var($_GET['recipe_id'],FILTER_SANITIZE_NUMBER_INT);
    
    echo $tagName;
    
    $tagName = ucfirst($tagName);
    
    $result = getTagByName($tagName);
    
    if(empty($result))
    {
        
        createTag($tagName);
        $tag_id = getTagIDByName($tagName);
        createRecipeTag($tag_id, $recipe_id);
    }else
    {
        createRecipeTag($result['tag_id'], $recipe_id);
    }
    
    echo $tagName." Tag added ";

?>