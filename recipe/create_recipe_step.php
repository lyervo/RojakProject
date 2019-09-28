<?php

    include "../db_connect.php";
    require "recipe_db.php";


    $step = $_REQUEST["step"];
    $recipe_id = $_REQUEST["recipeID"];
    
    echo $step."+".$recipe_id;
    
    create_step($recipe_id, $step);
    
    echo "reeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee";
    

?>