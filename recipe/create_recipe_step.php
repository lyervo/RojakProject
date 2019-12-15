<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    
    

    $step = filter_var($_POST['step'],FILTER_SANITIZE_STRING);
    $recipe_id = filter_var($_POST['recipe_id'],FILTER_SANITIZE_NUMBER_INT);
    $step_order = filter_var($_POST['step_order'],FILTER_SANITIZE_NUMBER_INT);
    
    $step = ucfirst($step);
    
    
    
    if(isset($_FILES['step_image']))
    {

        $filePath = $_FILES['step_image']['tmp_name'];
        
        $blob = fopen($filePath, 'rb');
        

        
        
        create_step_with_image($recipe_id,$step,$step_order,$blob);
        
        echo "An image request processed ".$step;
        
    }else
    {
        
        create_step($recipe_id, $step,$step_order);

        echo "a text request processed ".$step;
    }
    
    
    

?>