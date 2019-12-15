<?php

    include "../model/db_connect.php";
    
    require 'review_db.php';
    

    
    $review = filter_var($_GET['review'], FILTER_SANITIZE_STRING);
    
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    
    $recipe_id = filter_var($_GET['recipe_id'], FILTER_SANITIZE_NUMBER_INT);
    
    $rating = filter_var($_GET['rating'], FILTER_SANITIZE_NUMBER_INT);
    
    
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