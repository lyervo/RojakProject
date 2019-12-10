<?php

    include_once "../model/db_connect.php";
    require_once "review_db.php";
    require_once "../recipe/recipe_db.php";
    
    $id = 170;
    $result = getReviews($id);
    
    $total = 0;
    $count = 0;
    
    foreach($result as $res)
    {
        
        $total += $res['rating'];
        $count++;
    }
    
    
    
    $rating = $total/$count;
    
  
    
    update_rating($id, $rating);
    
    
