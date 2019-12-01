<?php
    
    include "../model/db_connect.php";
    require "recipe_db.php";

    $tagName = $_REQUEST['tag'];
    $recipe_id = $_REQUEST['recipe_id'];
    
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