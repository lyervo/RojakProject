<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    
    

    $step = $_POST["step"];
    $recipe_id = $_POST["recipe_id"];
    $step_order = $_POST['step_order'];
    
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