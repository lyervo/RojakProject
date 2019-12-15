<?php

    include "../model/db_connect.php";
    require_once "ticket_db.php";
    require_once "../review/review_db.php";
    require_once "../user/user_db.php";
    require_once '../recipe/recipe_db.php';
    
    $review_id = filter_var($_GET['review_id'], FILTER_SANITIZE_NUMBER_INT);
    $recipe_id = filter_var($_GET['recipe_id'], FILTER_SANITIZE_NUMBER_INT);
    
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
?>
    