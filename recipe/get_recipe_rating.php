<?php

    include "../model/db_connect.php";
    require_once 'recipe_db.php';
 
    $recipe_id = filter_var($_GET['recipe_id'],FILTER_SANITIZE_NUMBER_INT);
    
    $recipe = getRecipeByID($recipe_id);
    
    echo $recipe['rating'];
    
    ?>