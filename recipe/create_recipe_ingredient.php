<?php

    include "../model/db_connect.php";
    require 'recipe_db.php';
    
    $name = filter_var($_GET['name'],FILTER_SANITIZE_STRING);
    $amount = filter_var($_GET['amount'],FILTER_SANITIZE_NUMBER_FLOAT);
    $mod = filter_var($_GET['mod'],FILTER_SANITIZE_STRING);
    $unit = filter_var($_GET['unit'],FILTER_SANITIZE_STRING);
    $recipe_id = filter_var($_GET['recipeID'],FILTER_SANITIZE_NUMBER_INT);
    $vegan = 0;
    
    $ingredient_id = getIngredientIDByName($name);
    
    $name = ucfirst($name);
    
    if($ingredient_id===null)
    {
        createIngredient($name,$vegan);
        $ingredient_id = getIngredientIDByName($name);
        create_recipe_ingredient($ingredient_id, $recipe_id, $amount, $unit, $mod);
    }else
    {
        create_recipe_ingredient($ingredient_id, $recipe_id, $amount, $unit, $mod);
    }
    
    
    
    
    
    

?>