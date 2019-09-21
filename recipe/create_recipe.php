<?php

    include "../db_connect.php";
    require "recipe_db.php";

    $name = $_REQUEST["name"];
    $desc = $_REQUEST["desc"];
    $serving = $_REQUEST["serving"];
    
    create_recipe($name,$desc,$serving);
    
    $response = getRecipeIDByName($name);
    
    
    
    echo $response;

?>