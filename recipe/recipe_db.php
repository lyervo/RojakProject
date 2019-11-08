<?php

function create_recipe($name,$desc,$serving,$time,$difficulty,$author_id)
{
    global $db;
    $query = "insert into recipe values(null,'".$name."','".$desc."','".$serving."','".$difficulty."',".$time.",1,".$author_id.",null)";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_with_image($name,$desc,$serving,$time,$difficulty,$author_id,$blob)
{
    global $db;
    $query = "insert into recipe values(null,'".$name."','".$desc."','".$serving."','".$difficulty."',".$time.",1,".$author_id.",:blob)";
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_ingredient($ingredientID,$recipeID,$amount,$unit,$mod)
{
    global $db;
    $query = "insert into recipe_ingredient values(".$ingredientID.",".$recipeID.",".$amount.",'".$unit."','".$mod."')";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step($recipeID,$step)
{
    global $db;
    $query = "insert into step values(".$recipeID.",null,'".$step."',null)";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step_with_image($recipeID,$step,$blob)
{
    global $db;
    $query = "insert into step values(".$recipeID.",null,'".$step."',:blob)";
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->execute();
    $statement->closeCursor();
}


function getRecipeIDByName($name)
{
    global $db;
    $query = "select recipe_id from recipe where recipe_name = '".$name."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['recipe_id'];
    
}

function getRecipeByID($id)
{
    global $db;
    $query = "select * from recipe where recipe_id = '".$id."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
    
}

function getRecipeIngredientByID($id)
{
    global $db;
    $query = "select * from recipe_ingredient where recipe_id = '".$id."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    
    return $result;
}

function getStepByID($id)
{
    global $db;
    $query = "select * from step where recipe_id = '".$id."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    
    return $result;
}

function getIngredientNameByID($id)
{
    global $db;
    $query = "select ingredient_name from ingredient where ingredient_id = '".$id."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['ingredient_name'];
}

function getIngredientIDByName($name)
{
    global $db;
    $query = "select ingredient_id from ingredient where ingredient_name = '".$name."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if(empty($result))
    {
        return null;
    }else
    {
        return $result['ingredient_id'];
    }
}

function createIngredient($name,$vegan)
{
    global $db;
    $query = "insert into ingredient values(null,'".$name."',".$vegan.")";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function searchIngredient($name)
{
    global $db;
    $query = "select ingredient_name from ingredient where ingredient_name like '%".$name."%' or ingredient_name like '%".$name."' or ingredient_name like '".$name."%'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipe($name)
{
    global $db;
    $query = "select recipe_id,recipe_name,description from recipe where recipe_name like '%".$name."%' or recipe_name like '%".$name."' or recipe_name like '".$name."%'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipeOrderByName($name,$order,$tags,$noTags)
{
    global $db;
   
    if($noTags!=""||$tags!="")
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM 
                (recipe INNER JOIN (recipe_tag INNER JOIN tag ON recipe_tag.tag_id = tag.tag_id) ON recipe.recipe_id = recipe_tag.recipe_id)
                WHERE (recipe_name like '%".$name."%')".$tags.$noTags." "
                . "group by recipe.recipe_id order by recipe.recipe_name ".$order;
    }else
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM recipe WHERE recipe_name like '%".$name."%' group by recipe.recipe_id order by recipe_name ".$order;
    }
    
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipeOrderByTime($name,$order,$tags,$noTags)
{
    global $db;
    if($noTags!=""||$tags!="")
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM 
                (recipe INNER JOIN (recipe_tag INNER JOIN tag ON recipe_tag.tag_id = tag.tag_id) ON recipe.recipe_id = recipe_tag.recipe_id)
                WHERE (recipe_name like '%".$name."%')".$tags.$noTags." "
                . "group by recipe.recipe_id order by recipe.cooking_time ".$order;
    }else
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM recipe WHERE recipe_name like '%".$name."%' group by recipe.recipe_id order by cooking_time ".$order;
    }
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipeOrderByDate($name,$order,$tags,$noTags)
{
    global $db;
    
    if($noTags!=""||$tags!="")
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM 
                (recipe INNER JOIN (recipe_tag INNER JOIN tag ON recipe_tag.tag_id = tag.tag_id) ON recipe.recipe_id = recipe_tag.recipe_id)
                WHERE (recipe_name like '%".$name."%')".$tags.$noTags." "
                . "group by recipe.recipe_id order by recipe.submit_date ".$order;
    }else
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM recipe WHERE recipe_name like '%".$name."%' group by recipe.recipe_id order by submit_date ".$order;
    }
    
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipeOrderByRating($name,$order,$tags,$noTags)
{
    global $db;   
    if($noTags!=""||$tags!="")
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM 
                (recipe INNER JOIN (recipe_tag INNER JOIN tag ON recipe_tag.tag_id = tag.tag_id) ON recipe.recipe_id = recipe_tag.recipe_id)
                WHERE (recipe_name like '%".$name."%')".$tags.$noTags." "
                . "group by recipe.recipe_id order by rating ".$order;
    }else
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description FROM recipe WHERE recipe_name like '%".$name."%' group by recipe.recipe_id order by rating ".$order;
    }
    
    echo $query;
    
    
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}



function getTagByName($name)
{
    global $db;
    $query = "select * from tag where tag_name = '".$name."'";
    echo $query."/n";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    
    return $result;
}

function createTag($name)
{
    global $db;
    $query = "insert into tag values(null,'".$name."')";
    echo $query."        ";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getTagIDByName($name)
{
    global $db;
    $query = "select tag_id from tag where tag_name = '".$name."'";
    echo $query."       ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function createRecipeTag($tag,$recipe)
{
    global $db;
    $query = "insert into recipe_tag values(".$recipe.",".$tag.")";
    echo $query."      ";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getRecipeTags($recipe_id)
{
    global $db;
    $query = "SELECT tag.tag_id,tag.tag_name 
    FROM
    (tag INNER JOIN (recipe_tag INNER JOIN recipe ON recipe_tag.recipe_id = recipe.recipe_id) ON tag.tag_id = recipe_tag.tag_id)
    WHERE recipe.recipe_id = ".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
    
}

function deleteRecipeByID($recipe_id)
{
    global $db;    
    
    
    
    $query = "delete from recipe where recipe_id=".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();

}

function deleteLikeByID($recipe_id)
{
    global $db;    
    $query = "delete from likes where recipe_id=".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();

}

function deleteReviewByID($recipe_id)
{
    global $db;    
    $query = "delete from review where recipe_id=".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();

}

function deleteRecipeIngredientByID($recipe_id)
{
    global $db;    
    $query = "delete from recipe_ingredient where recipe_id=".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();

}

function deleteStepByID($recipe_id)
{
    global $db;    
    $query = "delete from step where recipe_id=".$recipe_id;

   
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();

}



?>