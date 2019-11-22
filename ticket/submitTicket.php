<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    
    $action = $_REQUEST['action'];
    $type = $_REQUEST['type'];
    
    if(!isset($_REQUEST['detail']))
    {
        $detail = "null";
    }else
    {
        $detail = $_REQUEST['detail'];
    }
    
    if($action==1)
    {
       
        $recipe_id = $_REQUEST['recipe_id'];
        $review_id = $_REQUEST['review_id'];
        
        if($review_id!=0)
        {
            $link = "?id=".$recipe_id."#review_".$review_id;
        }else
        {
            $link = "?id=".$recipe_id;
        }
        
        create_ticket($type, $link,$review_id,$recipe_id,0);
        echo "reported";
        
    }else if($action==2)
    {
        $user_id = $_REQUEST['user_id'];
        
        $link = "?user_id=".$user_id;
        
        create_ticket($type, $link, 0,0, $user_id);
        
        
        echo "reported";
    }
    
    