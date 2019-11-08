<?php

    include "../model/db_connect.php";
    require 'recipe_db.php';
    
    $recipe_id = $_REQUEST['recipe_id'];
    
    $tags = getRecipeTags($recipe_id);
    
    $response = "";
    
    foreach($tags as $t)
    {
        $response = $response."<a>".$t['tag_name']."</a>";
    }
    
    
    echo $response;