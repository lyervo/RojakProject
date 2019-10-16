<?php

    include "../db_connect.php";
    
    require 'review_db.php';
    
    $review = $_REQUEST['review'];
    
    $review = filter_var($review, FILTER_SANITIZE_STRING);
    
    $user_id = $_REQUEST['user_id'];
    
    $recipe_id = $_REQUEST['recipe_id'];
    
    create_review($review, $user_id, $recipe_id);