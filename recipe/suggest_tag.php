<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = filter_var($_GET['name'],FILTER_SANITIZE_STRING);
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);;
    
    $results = searchTag($name);
    
    $response = "";
    
    foreach($results as $result)
    {
        $response = $response."<button onclick=\"setTag('".$id."','".$result['tag_name']."')\">".$result['tag_name']."</button>";
    }
    
    echo $response;
    
    
?>