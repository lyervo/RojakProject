<?php

    include "../model/db_connect.php";
    require "ticket_db.php";
    
    $ticket_id = $_REQUEST['ticket_id'];
    
    deleteTicketByID($ticket_id);