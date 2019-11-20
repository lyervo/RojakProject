<?php


    include "../model/db_connect.php";
    require "recipe_db.php";

    $recipe_name = filter_var($_REQUEST["recipe_name"], FILTER_SANITIZE_STRING);    
    $result = getRecipeIDByName($recipe_name);
    
    echo $result;