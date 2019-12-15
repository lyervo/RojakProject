<?php


    include "../model/db_connect.php";
    require "recipe_db.php";

    $recipe_name = filter_var($_GET["recipe_name"], FILTER_SANITIZE_STRING);

    if(isset($_REQUEST['original_name']))
    {
        $original_name = filter_var($_REQUEST["original_name"], FILTER_SANITIZE_STRING);
        if($original_name == $recipe_name)
        {
            $result = -1;
        } else
        {
            $result = getRecipeIDByName($recipe_name);
        }
    }else
    {
        $result = getRecipeIDByName($recipe_name);
    }
    
    
    
    echo $result;
    
?>