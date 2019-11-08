<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    
    $action = $_REQUEST['action'];
    $type = $_REQUEST['type'];
    $recipe_id = $_REQUEST['recipe_id'];
    
    if($action==1)
    {
        
        $review_id = $_REQUEST['review_id'];
        
        if($review_id!=0)
        {
            $link = "?id=".$recipe_id."#review_".$review_id;
        }else
        {
            $link = "?id=".$recipe_id;
        }
        
        create_ticket($type, $link,$review_id,$recipe_id);
        echo "reported";
        
    }else if($type===2)
    {
        
    }
    
    