<?php
    
    include "../model/db_connect.php";
    require "recipe_db.php";

    $tagName = $_REQUEST['tag'];
    $recipe_id = $_REQUEST['recipe_id'];
    
    echo $tagName;
    
    $result = getTagByName($tagName);
    
    if(empty($result))
    {
        echo "run ewwwwwwwwwwwwwwwwwwwwwwww";
        createTag($tagName);
        $tag = getTagIDByName($tagName);
        createRecipeTag($tag['tag_id'], $recipe_id);
    }else
    {
        echo "i run";
        createRecipeTag($result['tag_id'], $recipe_id);
    }

?>