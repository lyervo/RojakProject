<?php

    include "../model/db_connect.php";
    require_once "ticket_db.php";
    
    $ticket_id = $_REQUEST['ticket_id'];
    
    $ticket = getTicketByID($ticket_id);
    removeRecipeWarning($ticket);
    deleteTicketByID($ticket_id);
    
    