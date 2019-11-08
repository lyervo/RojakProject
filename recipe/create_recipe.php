<?php

    include "../model/db_connect.php";
    require "recipe_db.php";

    
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $serving = $_POST["serving"];
    $time = $_POST["time"];
    $difficulty = $_POST["difficulty"];
    $author_id = $_POST["id"];
    
    
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