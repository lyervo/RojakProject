<?php

    include "../model/db_connect.php";
    require 'recipe_db.php';
    
    $name = $_REQUEST['name'];
    $amount = $_REQUEST['amount'];
    $mod = $_REQUEST['mod'];
    $unit = $_REQUEST['unit'];
    $recipe_id = $_REQUEST['recipeID'];
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