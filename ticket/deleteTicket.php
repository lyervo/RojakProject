<?php

    include "../model/db_connect.php";
    require_once "ticket_db.php";
    
    $ticket_id = filter_var($_GET['ticket_id'], FILTER_SANITIZE_NUMBER_INT);
    
    $ticket = getTicketByID($ticket_id);
    removeRecipeWarning($ticket);
    deleteTicketByID($ticket_id);
    
    ?>
    