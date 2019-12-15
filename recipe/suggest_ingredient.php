<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = filter_var($_GET['name'],FILTER_SANITIZE_STRING);
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    
    $results = searchIngredient($name);
    
    $response = "Suggestion(s):";
    
    foreach($results as $result)
    {
        $response = $response." <button id='suggest' onclick=\"setIngredient('".$id."','".$result['ingredient_name']."')\">".$result['ingredient_name']."</button>";
    }
    
    echo $response;
    
    
?>