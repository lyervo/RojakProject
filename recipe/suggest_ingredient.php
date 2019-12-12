<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
    
    $results = searchIngredient($name);
    
    $response = "Suggestion(s):";
    
    foreach($results as $result)
    {
        $response = $response." <button id='suggest' onclick=\"setIngredient('".$id."','".$result['ingredient_name']."')\">".$result['ingredient_name']."</button>";
    }
    
    echo $response;
    
    
?>