<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    
    $type = $_REQUEST['type'];
    
    if(!isset($_REQUEST['detail']))
    {
        $detail = "null";
    }else
    {
        $detail = $_REQUEST['detail'];
    }
    
    $user_id = $_REQUEST['user_id'];
    $recipe_id = $_REQUEST['recipe_id'];
    $review_id = $_REQUEST['review_id'];
    
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
    
    
    