<?php

    include "../model/db_connect.php";
    
    require "ticket_db.php";
    require "../user/user_db.php";
    
    
    $user_id = $_REQUEST['user_id'];
    
    
    deleteUser($user_id);
    deleteTicketByUserID($user_id);
    
    