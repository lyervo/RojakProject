<?php

function create_ticket($detail,$type,$link,$review_id,$recipe_id,$user_id)
{
    global $db;
    $query = "insert into ticket values(null,null,'".$type."','".$detail."','".$link."','".$review_id."','".$recipe_id."','".$user_id."',null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getTickets($order,$type,$content,$asc)
{
    global $db;
    
        $query = 'select ticket_id,date_submitted,ticket_type,detail,link,review_id,recipe_id,user_id,deadline,
                    CASE WHEN deadline < now() then "Deadline Overdue"
                    when deadline IS NULL then ""
                    ELSE "Not overdue" END AS deadline_info
                    from ticket ';
    $first = true;
    if($type!="all")
    {
        $first = false;
        $query = $query."where ticket_type='".$type."' ";
    }
    
    if($content!="all")
    {
        if($first)
        {
            $query = $query."where ";
        }else
        {
            $query = $query."and ";
        }
        
        if($content == "user")
        {
            $query = $query."review_id = 0 and recipe_id = 0 ";
        }else if($content == "review")
        {
            $query = $query."user_id = 0 and not(review_id = 0)";
        }else if($content == "recipe")
        {
            $query = $query."review_id = 0 and user_id = 0 ";
        }
        
    }
    
    $query = $query.'order by '.$order.' '.$asc;
    

    
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

function getTicketByID($ticket_id)
{
    global $db;
    $query = "select * from ticket where ticket_id=".$ticket_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function setTicketDeadline($ticket_id)
{
    global $db;
    $query = "update ticket set deadline = DATE_ADD(NOW(), INTERVAL 3 DAY) where ticket_id=".$ticket_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    
}

function setRecipeWarning($ticket)
{
    global $db;
    $warning = "Warning: This recipe has been mark by the admin for the following reason - ".$ticket['ticket_type']." - ".$ticket['detail'].", caution is adviced for users who intend to follow this recipe.";
    $query = "update recipe set warning = '".$warning."' where recipe_id=".$ticket['recipe_id'];
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function removeRecipeWarning($ticket)
{
    global $db;
    $query = "update recipe set warning = null where recipe_id=".$ticket['recipe_id'];
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}
