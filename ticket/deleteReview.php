<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    require "../review/review_db.php";
    require "../user/user_db.php";
    require '../recipe/recipe_db.php';
    
    $review_id = $_REQUEST['review_id'];
    $recipe_id = $_REQUEST['recipe_id'];
    
    if($review_id==0)
    {
//        addUserStrike($res['user_id']);

        deleteRecipeByID($recipe_id);

        deleteTicketByRecipeID($recipe_id);
    }else if($review_id>0)
    {
        $res = getReviewByID($review_id);
    
//        addUserStrike($res['user_id']);

        deleteReviewByID($review_id);

        deleteTicketByReviewID($review_id);
    }

    