<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $desc = filter_var($_POST["desc"], FILTER_SANITIZE_STRING);
    $serving = filter_var($_POST["serving"], FILTER_SANITIZE_NUMBER_INT);
    $time = filter_var($_POST["time"], FILTER_SANITIZE_NUMBER_INT);
    $difficulty = filter_var($_POST["difficulty"], FILTER_SANITIZE_STRING);
    $author_id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    
    $name = ucfirst($name);
    $desc = ucfirst($name);
    
    if(isset($_FILES['image_file']))
    {
        
        $filePath = $_FILES['image_file']['tmp_name'];
        
        $blob = fopen($filePath, 'rb');
       
        
        
        create_recipe_with_image($name,$desc,$serving,$time,$difficulty,$author_id,$blob);
        
    }else
    {
        create_recipe($name,$desc,$serving,$time,$difficulty,$author_id);
    }
        
    
    $response = getRecipeIDByName($name);
    
    
    
    echo $response;

?>