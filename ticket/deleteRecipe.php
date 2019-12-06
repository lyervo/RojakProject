<?php

    include "../model/db_connect.php";
    require_once "ticket_db.php";
    require_once "../recipe/recipe_db.php";
    require_once "../user/user_db.php";
    require_once "../like/like_db.php";
    require_once "../review/review_db.php";
    $recipe_id = $_REQUEST['recipe_id'];
    
    deleteLikeByID($recipe_id);
    deleteReviewByRecipeID($recipe_id);
    deleteStepByID($recipe_id);
    deleteRecipeIngredientByID($recipe_id);

    deleteRecipeByID($recipe_id);

    deleteTicketByRecipeID($recipe_id);