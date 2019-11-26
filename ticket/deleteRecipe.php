<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    require "../recipe/recipe_db.php";
    require "../user/user_db.php";
    require "../like/like_db.php";
    require "../review/review_db.php";
    $recipe_id = $_REQUEST['recipe_id'];
    
    deleteLikeByID($recipe_id);
    deleteReviewByRecipeID($recipe_id);
    deleteStepByID($recipe_id);
    deleteRecipeIngredientByID($recipe_id);

    deleteRecipeByID($recipe_id);

    deleteTicketByRecipeID($recipe_id);
    echo "operation complete";