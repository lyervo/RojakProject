<?php

    include "../model/db_connect.php";
    
    require "ticket_db.php";
    require "../user/user_db.php";
    
    
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    
    
    deleteUser($user_id);
    deleteTicketByUserID($user_id);
    
    ?>