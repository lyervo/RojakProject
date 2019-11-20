<?php
function create_recipe($name,$desc,$serving,$time,$difficulty,$author_id)
{
    global $db;
    $query = "insert into recipe values(null,'".$name."','".$desc."','".$serving."','".$difficulty."',".$time.",1,".$author_id.",null,null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_with_image($name,$desc,$serving,$time,$difficulty,$author_id,$blob)
{
    global $db;
    $query = "insert into recipe values(null,'".$name."','".$desc."','".$serving."','".$difficulty."',".$time.",1,".$author_id.",null,:blob);";
    
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_ingredient($ingredientID,$recipeID,$amount,$unit,$mod)
{
    global $db;
    $query = "insert into recipe_ingredient values(".$ingredientID.",".$recipeID.",".$amount.",'".$unit."','".$mod."');";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step($recipeID,$step)
{
    global $db;
    $query = "insert into step values(".$recipeID.",null,'".$step."',null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step_with_image($recipeID,$step,$blob)
{
    global $db;
    $query = "insert into step values(:id,null,:step,:blob);";
    echo "RecipeID".$recipeID;
    echo "STEP".$step;
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->bindParam(':id',$recipeID);
    $statement->bindParam(':step',$step);
    $statement->execute();
    $statement->closeCursor();
}


function getRecipeIDByName($name)
{
    global $db;
    $query = "select recipe_id from recipe where lower(recipe_name) = lower('".$name."')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if(empty($result))
    {
        return -1;
    }else
    {
        return $result['recipe_id'];
    }
    
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
    $query = "select ingredient_id from ingredient where lower(ingredient_name) = lower('".$name."')";
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
    $query = "insert into ingredient values(null,'".$name."',".$vegan.");";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function searchIngredient($name)
{
    global $db;
    $query = "select ingredient_name from ingredient where lower(ingredient_name) like lower('%".$name."%')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchTag($name)
{
    global $db;
    $query = "select tag_name from tag where lower(tag_name) like lower('%".$name."%')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipe($name,$sort,$order)
{
    global $db;
    if($name == "null")
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description "
                    . "FROM recipe"
                    . " order by recipe.".$sort." ".$order;
    }else
    {
        $query = "SELECT recipe.recipe_id,recipe.recipe_name,recipe.description "
                    . "FROM recipe WHERE "
                    . "lower(recipe_name) like lower('%".$name."%')"
                    . " order by recipe.".$sort." ".$order;
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
    $query = "select * from tag where lower(tag_name) = lower('".$name."')";
    echo $query."/n";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    
    if(empty($result))
    {
        return null;
    }else
    {
        
        return $result;
    }
}

function createTag($name)
{
    global $db;
    $query = "insert into tag values(null,'".$name."')";
    echo $query."/n";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getTagIDByName($name)
{
    global $db;
    $query = "select tag_id from tag where lower(tag_name) = lower('".$name."')";
    echo $query."/n";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    if(empty($result))
    {
        return null;
    }else
    {
        return $result['tag_id'];
    }
}

function deleteRecipeByID($id)
{
    global $db;
    $query = "delete from recipe where recipe_id = ".$id;

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function createRecipeTag($tag,$recipe)
{
    global $db;
    $query = "insert into recipe_tag values('".$recipe."','".$tag."')";
    echo $query."/n";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function filterResults($tag,$noTag,$recipe_id)
{
    global $db;

    $tag = strtolower($tag);
    $noTag = strtolower($noTag);
    
    $tags = explode("%%",$tag);
    
    $noTags = explode("%%",$noTag);
    $query = "SELECT tag.tag_name FROM (tag INNER JOIN recipe_tag ON tag.tag_id = recipe_tag.tag_id) WHERE recipe_tag.recipe_id = ".$recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result =$statement->fetchAll();
    $statement->closeCursor();

    $valid = true;
    
    if($tag!="null")
    {
        $size = sizeof($tags);
    }else
    {
        $size = 0;
    }
    $size_valid = 0;
    
    foreach($result as $res)
    {

        if($noTag!=="null")
        {
            if(in_array($res['tag_name'],$noTags))
            {
                $valid = false;
            }
        }
    
        $second_valid = false;
        if($tag!=="null")
        {
            foreach($tags as $t)
            {
                $value = strcmp($t, $res['tag_name']);
                if($value===0)
                {
                    $size_valid = $size_valid+1;

                    $second_valid = true;

                }
            }
        }
    }
    
    
    
    

    
    return $valid&&($size===$size_valid); 
}

?>