<?php

    include "../db_connect.php";
    require "recipe_db.php";

    $name = $_REQUEST["name"];
    $desc = $_REQUEST["desc"];
    $serving = $_REQUEST["serving"];
    $time = $_REQUEST["time"];
    $difficulty = $_REQUEST["difficulty"];
    
    create_recipe($name,$desc,$serving,$time,$difficulty);
    
    $response = getRecipeIDByName($name);
    
    
    
    echo $response;

?>