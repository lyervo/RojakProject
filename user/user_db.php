<?php

function create_user($username,$email,$password,$gender)
{
    global $db;
    $query = "insert into user values(null,'".$username."','".$email."','".$password."','".$gender."');";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteUser($id)
{
    global $db;
    $query = "delete from user where user_id = ".$id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}





?>