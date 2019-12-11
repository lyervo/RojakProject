<?php

    include '../model/db_connect.php';
    require "user_db.php";
    
    
    $user_id = $_REQUEST['user_id'];
    
    $result = getUserLikedRecipes($user_id);
    
    if(empty($result))
    {
        $response = "This user has no liked recipe yet.";
    }else
    {
        $response = "";
        foreach($result as $res)
        {
           $response = $response."<div class='div1'><div class='uploadRecipeCard'><a href='../controller/?action=view_recipe&id=" . $res['recipe_id'] . "'><img id='recipe_picture' src='data:image/jpeg;base64," . base64_encode($res['image_blob']) . "' height='120px' width='220px'/><br><br><h5 id='user_page_recipe_title'>" . $res['recipe_name'] . "</h5></a><br></div></div>";
        }
    }
    
    echo $response;
    