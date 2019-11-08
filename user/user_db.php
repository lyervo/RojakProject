<?php

function getUserByID($user_id)
{
    global $db;
    $query = "select * from user where user_id = ".$user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

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

function getUserLikedRecipes($user_id)
{
    global $db;
    $query = "SELECT recipe.recipe_id,recipe.recipe_name FROM 
            (recipe INNER JOIN 
            (likes INNER JOIN user ON likes.user_id = user.user_id)
            ON recipe.recipe_id = likes.recipe_id) WHERE user.user_id = ".$user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function addUserStrike($user_id)
{
    global $db;
    $query = "update user set strike = strike+1 where user_id=".$user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getUserCountByStrikes($strikes)
{
    global $db;
    $query = "select count(user_id) from user where strike > ".$strikes;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['count(user_id)'];
}

function deleteUsersByStrikes($strikes)
{
    global $db;
    $query = "delete from user where strike > ".$strikes;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}


?>