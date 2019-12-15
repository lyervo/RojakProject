<?php

    include "../model/db_connect.php";
    require 'ticket_db.php';
    
    $ticket_id = filter_var($_GET['ticket_id'], FILTER_SANITIZE_NUMBER_INT);
    
    $ticket = getTicketByID($ticket_id);
    
    setTicketDeadline($ticket_id);
    
    if($ticket['recipe_id']!=0&&$ticket['review_id']==0&&$ticket['user_id']==0)
    {
        setRecipeWarning($ticket);
    }
    
    ?>