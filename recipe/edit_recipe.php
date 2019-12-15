<?php

    include "../model/db_connect.php";

    require_once 'recipe_db.php';
    
    $recipe_id = filter_var($_REQUEST["recipe_id"],FILTER_SANITIZE_NUMBER_INT);
    $recipe_name = filter_var($_REQUEST["recipe_name"], FILTER_SANITIZE_STRING);
    $desc = filter_var($_REQUEST["desc"], FILTER_SANITIZE_STRING);
    $serving = filter_var($_REQUEST["serving"], FILTER_SANITIZE_NUMBER_INT);
    $time = filter_var($_REQUEST["time"], FILTER_SANITIZE_NUMBER_INT);
    $difficulty = filter_var($_REQUEST["difficulty"], FILTER_SANITIZE_STRING);
    $youtube = $_REQUEST['youtube'];
    
    $recipe_name = ucfirst($recipe_name);
    $desc = ucfirst($desc);
    
    
    deleteAssociatedRecipeValue($recipe_id);
    
    if(isset($_FILES['image_file']))
    {
        
        $filePath = $_FILES['image_file']['tmp_name'];
        
        $blob = fopen($filePath, 'rb');
       
        

        editRecipe($recipe_id,$recipe_name,$desc,$serving,$difficulty,$time,$youtube,$blob);
        
    }else
    {
        editRecipe($recipe_id,$recipe_name,$desc,$serving,$difficulty,$time,$youtube,null);
    }
        
    
    
    
    
    
    echo $recipe_id;
    
    ?>