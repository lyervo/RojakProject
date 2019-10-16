<?php

    include "../db_connect.php";
    require "like_db.php";
    
    
    $recipe_id = $_REQUEST['recipe_id'];
    
    $likes = getLikeCount($recipe_id);
    
    
    
    echo $likes['count(user_id)'];