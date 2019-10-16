<?php
    
    include "../db_connect.php";
    require "recipe_db.php";

    $tagName = $_REQUEST['tag'];
    $recipe_id = $_REQUEST['recipe_id'];
    
    echo $tagName;
    
    $result = getTagByName($tagName);
    
    if($result === null)
    {
        echo "run";
        createTag($tagName);
        $tag_id = getTagIDByName($tagName);
        createRecipeTag($tag_id, $recipe_id);
    }else
    {
        createRecipeTag($result['tag_id'], $recipe_id);
    }

?>