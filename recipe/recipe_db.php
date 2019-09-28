<?php

function create_recipe($name,$desc,$serving)
{
    global $db;
    $query = "insert into recipe values(null,'".$name."','".$desc."','".$serving."',null)";
    $statement = $db->prepare($query);
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
    $query = "insert into step values(".$recipeID.",null,'".$step."')";
    $statement = $db->prepare($query);
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




?>