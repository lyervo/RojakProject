<?php

    include '../model/db_connect.php';
    require 'recipe_db.php';
    
    
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
    
    $results = searchTag($name);
    
    $response = "";
    
    foreach($results as $result)
    {
        $response = $response."<button onclick=\"setTag('".$id."','".$result['tag_name']."')\">".$result['tag_name']."</button>";
    }
    
    echo $response;
    
    
?>