<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    
    $type = filter_var($_GET['type'], FILTER_SANITIZE_STRING);
    
    if(!isset($_GET['detail']))
    {
        $detail = "null";
    }else
    {
        $detail = filter_var($_GET['detail'], FILTER_SANITIZE_STRING);
    }
    
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $recipe_id = filter_var($_GET['recipe_id'], FILTER_SANITIZE_NUMBER_INT);
    $review_id = filter_var($_GET['review_id'], FILTER_SANITIZE_NUMBER_INT);
    
    if($user_id!=0)
    {
        $link = "?action=user_profile&user_id=".$user_id;
    }else if($review_id!=0)
    {
        $link = "?action=view_recipe&id=".$recipe_id."#review".$review_id;
    }else
    {
        $link = "?action=view_recipe&id=".$recipe_id;
    }
    create_ticket($detail,$type,$link,$review_id,$recipe_id,$user_id);
    echo "Report Submitted";
    
    ?>d
    
    
    