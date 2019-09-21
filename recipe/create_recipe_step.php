<?php

    include "../db_connect.php";
    require "recipe_db.php";


    $step = $_REQUEST["step"];
    $recipe_id = $_REQUEST["recipeID"];
    
    
    create_step($recipe_id, $step)
    

?>