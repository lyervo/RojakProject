<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = $_REQUEST['name'];
    
    $results = searchIngredient($name);
    
    $response = "";
    
    foreach($results as $result)
    {
        $response = $response."<p>".$result['ingredient_name']."</p>";
    }
    
    echo $response;
    
    
?>