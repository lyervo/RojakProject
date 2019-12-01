<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
    
    $results = searchIngredient($name);
    
    $response = "";
    
    foreach($results as $result)
    {
        $response = $response."<button onclick=\"setIngredient('".$id."','".$result['ingredient_name']."')\">".$result['ingredient_name']."</button>";
    }
    
    echo $response;
    
    
?>