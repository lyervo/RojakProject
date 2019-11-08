<?php

function likeRecipe($recipe_id,$user_id)
{
    global $db;
    $like = getLike($recipe_id, $user_id);
    if(empty($like))
    {
        $query = "insert into likes values(".$user_id.",".$recipe_id.")";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        return 1;
    
    } else
    {
        $query = "delete from likes where user_id = ".$user_id." and recipe_id = ".$recipe_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        return 0;
    }
    
}



function getLike($recipe_id,$user_id)
{
    global $db;
    $query = "select * from likes where user_id = ".$user_id." and recipe_id = ".$recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function getLikeCount($recipe_id)
{
    global $db;
    $query = "select count(user_id) from likes where recipe_id = ".$recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}