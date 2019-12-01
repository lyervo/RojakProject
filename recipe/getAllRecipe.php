<?php

    include "../model/db_connect.php";

    require "recipe_db.php";

    $result = getAllRecipe();
    
    $response = "";
    
    foreach($result as $res)
    {
        $response = $response.printRecipe($res);
    }
    
    echo $response;