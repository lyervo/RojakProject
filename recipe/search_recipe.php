<?php 

    include "../db_connect.php";
    
    require "recipe_db.php";
    
    $term = $_REQUEST['term'];
    
    $result = searchRecipe($term);
    
    
    $response = "";
    
    
    foreach ($result as $res)
    {
        $response = $response."<p><h2><a href='view_recipe.php?id=".$res['recipe_id']."'>".$res['recipe_name']."</h2></a></p><p>".$res['description']."</p>";
    }
    
    
    echo $response;

?>