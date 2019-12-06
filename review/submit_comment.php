<?php

    include "../model/db_connect.php";
    
    require 'review_db.php';
    
    $review = $_REQUEST['review'];
    
    $review = filter_var($review, FILTER_SANITIZE_STRING);
    
    $user_id = $_REQUEST['user_id'];
    
    $recipe_id = $_REQUEST['recipe_id'];
    
    $rating = $_REQUEST['rating'];
    
    if($rating>5)
    {
        return;
    }
    
    $result = getReviewByUserIDRecipeID($user_id,$recipe_id);
    if(empty($result))
    {
        create_review($review, $user_id, $recipe_id,$rating);
    }else
    {
        edit_review($result['review_id'],$review, $rating);
    }
    
    $id = $recipe_id;
    
    include "refreshRating.php";