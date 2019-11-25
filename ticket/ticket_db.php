<?php

function create_ticket($type,$link,$review_id,$recipe_id,$user_id)
{
    global $db;
    $query = "insert into ticket values(null,null,'".$type."','".$link."','".$review_id."','".$recipe_id."','".$user_id."');";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getTickets($order)
{
    global $db;
    $query = "select * from ticket order by ".$order;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function deleteTicketByID($ticket_id)
{
    global $db;
    $query = "delete from ticket where ticket_id=".$ticket_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteTicketByUserID($user_id)
{
    global $db;
    $query = "delete from ticket where user_id=".$user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteTicketByReviewID($review_id)
{
    global $db;
    $query = "delete from ticket where review_id=".$review_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteTicketByRecipeID($recipe_id)
{
    global $db;
    $query = "delete from ticket where recipe_id=".$recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}