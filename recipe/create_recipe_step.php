<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    
  

    $step = $_POST["step"];
    $recipe_id = $_POST["recipe_id"];
    
    $step = ucfirst($step);
    
    if(isset($_FILES['step_image']))
    {

        $filePath = $_FILES['step_image']['tmp_name'];
        
        $blob = fopen($filePath, 'rb');
        
        
        
        create_step_with_image($recipe_id,$step,$blob);
        
    }else
    {
        create_step($recipe_id, $step);
    }
    
    
    
    

?>