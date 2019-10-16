<?php
    
    include "../db_connect.php";
    require "like_db.php";
    
    
    
    $user_id = $_REQUEST['user_id'];
    $recipe_id = $_REQUEST['recipe_id'];
    
    $response = likeRecipe($recipe_id, $user_id);
    
    
    
    
    
    echo $response;
    
    
    
?>

