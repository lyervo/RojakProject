<?php

function create_recipe($name, $desc, $serving, $time, $difficulty, $author_id, $youtube) {
    global $db;
    $query = "insert into recipe values(null,'" . $name . "','" . $desc . "','" . $serving . "','" . $difficulty . "'," . $time . ",1," . $author_id . ",null,null,'" . $youtube . "',null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_with_image($name, $desc, $serving, $time, $difficulty, $author_id, $blob, $youtube) {
    global $db;
    $query = "insert into recipe values(null,'" . $name . "','" . $desc . "','" . $serving . "','" . $difficulty . "'," . $time . ",1," . $author_id . ",null,null,'" . $youtube . "',:blob);";
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->execute();
    $statement->closeCursor();
}

function create_recipe_ingredient($ingredientID, $recipeID, $amount, $unit, $mod) {
    global $db;
    $query = "insert into recipe_ingredient values(" . $ingredientID . "," . $recipeID . "," . $amount . ",'" . $unit . "','" . $mod . "');";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step($recipeID, $step, $step_order) {
    global $db;
    $query = "insert into step values(" . $recipeID . ",null," . $step_order . ",'" . $step . "',null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function create_step_with_image($recipeID, $step, $step_order, $blob) {
    global $db;
    $query = "insert into step values(:id,null,:step_order,:step,:blob);";

    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->bindParam(':id', $recipeID);
    $statement->bindParam(':step', $step);
    $statement->bindParam(':step_order', $step_order);
    $statement->execute();
    $statement->closeCursor();
}

function getRecipeIDByName($name) {
    global $db;
    $query = "select recipe_id from recipe where lower(recipe_name) = lower('" . $name . "')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if (empty($result)) {
        return -1;
    } else {
        return $result['recipe_id'];
    }
}

function getRecipeByID($id) {
    global $db;
    $query = "select * from recipe where recipe_id = '" . $id . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function getRecipeByAuthor($user_id) {
    global $db;
    $query = "select * from recipe where author = '" . $user_id . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getRecipeIngredientByID($id) {
    global $db;
    $query = "select * from recipe_ingredient where recipe_id = '" . $id . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function getStepByID($id) {
    global $db;
    $query = "select * from step where recipe_id = '" . $id . "' order by step_order";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    return $result;
}

function getIngredientNameByID($id) {
    global $db;
    $query = "select ingredient_name from ingredient where ingredient_id = '" . $id . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['ingredient_name'];
}

function getIngredientIDByName($name) {
    global $db;
    $query = "select ingredient_id from ingredient where lower(ingredient_name) = lower('" . $name . "')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if (empty($result)) {
        return null;
    } else {
        return $result['ingredient_id'];
    }
}

function createIngredient($name, $vegan) {
    global $db;
    $query = "insert into ingredient values(null,'" . $name . "'," . $vegan . ");";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function searchIngredient($name) {
    global $db;
    $query = "select ingredient_name from ingredient where lower(ingredient_name) like lower('%" . $name . "%')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchTag($name) {
    global $db;
    $query = "select tag_name from tag where lower(tag_name) like lower('%" . $name . "%')";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function searchRecipe($name, $sort, $order) {
    global $db;
    if ($name == "null") {
        $query = "SELECT * "
                . "FROM recipe"
                . " order by recipe." . $sort . " " . $order;
    } else {
        $query = "SELECT * "
                . "FROM recipe WHERE "
                . "lower(recipe_name) like lower('%" . $name . "%')"
                . " order by recipe." . $sort . " " . $order;
    }

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getTagByName($name) {
    global $db;
    $query = "select * from tag where lower(tag_name) = lower('" . $name . "')";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    if (empty($result)) {
        return null;
    } else {

        return $result;
    }
}

function createTag($name) {
    global $db;
    $query = "insert into tag values(null,'" . $name . "')";

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getTagIDByName($name) {
    global $db;
    $query = "select tag_id from tag where lower(tag_name) = lower('" . $name . "')";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if (empty($result)) {
        return null;
    } else {
        return $result['tag_id'];
    }
}

function deleteRecipeByID($id) {
    global $db;
    $query = "delete from recipe where recipe_id = " . $id;

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function createRecipeTag($tag, $recipe) {
    global $db;
    $query = "insert into recipe_tag values('" . $recipe . "','" . $tag . "')";

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function filterResults($tag, $noTag, $recipe_id) {
    global $db;

    $tag = strtolower($tag);
    $noTag = strtolower($noTag);

    $tags = explode("%%", $tag);

    $noTags = explode("%%", $noTag);
    $query = "SELECT tag.tag_name FROM (tag INNER JOIN recipe_tag ON tag.tag_id = recipe_tag.tag_id) WHERE recipe_tag.recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    $valid = true;

    if ($tag != "null") {
        $size = sizeof($tags);
    } else {
        $size = 0;
    }
    $size_valid = 0;

    foreach ($result as $res) {

        if ($noTag !== "null") {
            if (in_array(strtolower($res['tag_name']), $noTags)) {
                $valid = false;
            }
        }

        $second_valid = false;
        if ($tag !== "null") {
            foreach ($tags as $t) {
                $value = strcmp($t, strtolower($res['tag_name']));
                if ($value === 0) {
                    $size_valid = $size_valid + 1;

                    $second_valid = true;
                }
            }
        }
    }






    return $valid && ($size === $size_valid);
}

function getUserFrequentTags($user_id) {
    global $db;
    $query = "SELECT recipe_tag.tag_id,COUNT(recipe_tag.tag_id) "
            . "FROM (recipe_tag INNER JOIN likes ON likes.recipe_id = recipe_tag.recipe_id) "
            . "inner join tag on tag.tag_id = recipe_tag.tag_id "
            . "WHERE likes.user_id = " . $user_id . " and (lower(tag.tag_name) not like '%allergy%') GROUP BY recipe_tag.tag_id order by count(recipe_tag.tag_id) desc limit 3";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getRandomTags($num) {
    global $db;
    $query = "SELECT tag_id from tag where (lower(tag_name) not like '%allergy%') order by rand() limit  " . $num;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getTagNameById($id) {
    global $db;
    $query = "SELECT tag_name from tag where tag_id = " . $id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['tag_name'];
}

function getRecipeWithTag($tag) {
    global $db;
    $query = "SELECT recipe.recipe_id,recipe.rating, recipe.recipe_name, recipe.description,recipe.image_blob,recipe.author,recipe.difficulty,recipe.cooking_time "
            . "FROM (recipe INNER join recipe_tag ON recipe.recipe_id = recipe_tag.recipe_id)"
            . " INNER JOIN tag ON recipe_tag.tag_id = tag.tag_id WHERE tag.tag_name = '" . $tag . "'"
            . " order by rand() limit 5";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getAuthorByRecipeId($recipe_id) {
    global $db;
    $query = "select author from recipe where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['author'];
}

function getIngredientByRecipeID($recipe_id) {
    global $db;
    $query = "select * from recipe_ingredient where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getStepCountByID($recipe_id) {
    global $db;
    $query = "select count(recipe_id) from step where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result["count(recipe_id)"];
}

function getIngredientCountByID($recipe_id) {
    global $db;
    $query = "select count(recipe_id) from recipe_ingredient where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result["count(recipe_id)"];
}

function getTagCountByID($recipe_id) {
    global $db;
    $query = "select count(recipe_id) from recipe_tag where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result["count(recipe_id)"];
}

function getTagByRecipeID($recipe_id) {
    global $db;
    $query = "select * from recipe_tag where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function editRecipe($recipe_id, $recipe_name, $desc, $serving, $difficulty, $cooking_time, $youtube, $blob) {
    global $db;
    $query = "UPDATE `recipe` SET `recipe_name`= :recipe_name,`description`= :desc,"
            . " `serving`= :serving,`difficulty`= :difficulty,`cooking_time`= :cooking_time"
            . ",youtube = :youtube,`image_blob`= :blob WHERE recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->bindParam(':recipe_name', $recipe_name);
    $statement->bindParam(':desc', $desc);
    $statement->bindParam(':serving', $serving);
    $statement->bindParam(':difficulty', $difficulty);
    $statement->bindParam(':cooking_time', $cooking_time);
    $statement->bindParam(':youtube', $youtube);
    $statement->execute();
    $statement->closeCursor();
}

function deleteAssociatedRecipeValue($recipe_id) {
    global $db;
    deleteStepById($recipe_id);
    deleteRecipeIngredientByID($recipe_id);
    deleteRecipeTagById($recipe_id);
}

function deleteStepById($recipe_id) {
    global $db;
    $query = "delete from step where recipe_id = " . $recipe_id;

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteRecipeTagById($recipe_id) {
    global $db;
    $query = "delete from recipe_tag where recipe_id = " . $recipe_id;

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteRecipeIngredientById($recipe_id) {
    global $db;
    $query = "delete from recipe_ingredient where recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function showuser() {
    global $db;
    $query = " SELECT user.user_id,user.username,recipe.recipe_id,recipe.recipe_name,recipe.difficulty,recipe.cooking_time,recipe.image_blob,recipe.description,recipe.serving,recipe.author FROM recipe
    INNER JOIN user ON user.user_id = recipe.author ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getAllRecipe() {
    global $db;
    $query = " SELECT * from recipe order by rand() ";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function printRecipe($recipe) {

    require_once '../user/user_db.php';


    $response = '<div class="div1"><div class="recipecard">';

    if ($recipe['image_blob'] == "null" || $recipe['image_blob'] == null) {
        $response = $response . '<a href="?action=view_recipe&id=' . $recipe['recipe_id'] . '"><img src="../images/logo.jpg" height="160px" width="250px"/></a>';
    } else {

        $response = $response . '<a href="?action=view_recipe&id=' . $recipe['recipe_id'] . '"><img src="data:image/jpeg;base64,' . base64_encode($recipe['image_blob']) . '" height="160px" width="250px"/></a>';
    }
    $response = $response . '<div class="name"> <h2 id="recipe_title"><a style="text-decoration: none; color: black;" href="?action=view_recipe&id=' . $recipe['recipe_id'] . '">' . $recipe['recipe_name'] . '</h2></div>
                            <div class="prod_details_tab">';

    $dif = $recipe['difficulty'];
    $easy = 'Easy';
    $medium = 'Medium';
    $hard = 'Hard';

    if ($dif == $easy) {

        $response = $response . '
                                    <i id="iconEasy" class="fas fa-utensils">
                                        <div id="diff"><p id="diff_title">Easy</p></div>
                                    </i>
                                 ';
    }
    if ($dif == $hard) {

        $response = $response . '
                                    <i id="icon1Hard" class="fas fa-utensils">
                                    
                                    </i>
                                
                                    <i id="icon2Hard" class="fas fa-utensils">
                                    <div id="diff"><p id="diff_title">Hard</p></div>
                                    </i>
                                
                                    <i id="icon3Hard" class="fas fa-utensils">
                                    
                                    </i>';
    }

    if ($dif == $medium) {

        $response = $response . '
                                    <i id="icon1Med" class="fas fa-utensils">
                                    <div id="diff_m"><p id="diff_title">Medium</p></div>
                                    </i> 
                                
                                    <i id="icon2Med" class="fas fa-utensils">
                                    
                                    </i>';
    }

    $username = getUserByID($recipe['author']);

    if (!isset($recipe['rating'])) {
        $rating = 0;
    } else {
        $rating = $recipe['rating'];
    }

    $response = $response . '</div><br><p class="info">By <a href="?action=user_profile&user_id=' . $recipe['author'] . '">' . $username['username'] . '</a></p>';
    $response = $response . '<p class="info">Cooking Time: ' . $recipe["cooking_time"] . ' min</p>';
    //$response = $response . '<p class="info">' . $rating ;
     for ($i = 1; $i <= $recipe['rating'] ;$i++){
                $response = $response . '<img id="rate_star_home" src="../images/star_active.png"/>';
            }  
    //. '<img id="rate_star_home" src="../images/star_active.png"/></p>';

    $response = $response . '<div class="fadeingdescriptions"><p>' . $recipe['description'] . '</p></div> <p><button id="button_view"><a id="view_button" href="?action=view_recipe&id=' . $recipe['recipe_id'] . '">View</a></button></p></div></div>';
    return $response;
}

function print_my_recipe($recipe) {
    $response = "<div class='div1'><div class='uploadRecipeCard'><a href='../controller/?action=view_recipe&id=" . $recipe['recipe_id'] . "'><img id='recipe_picture' src='data:image/jpeg;base64," . base64_encode($recipe['image_blob']) . "' height='120px' width='220px'/><br><br><h5 id='user_page_recipe_title'>" . $recipe['recipe_name'] . "</h5></a><br><div class ='user_option'><a href='../controller/?action=edit_recipe&recipe_id=" . $recipe['recipe_id'] . "'><i class='fas fa-edit'></i>&nbspEdit this recipe</a><br><button id='delete_button' onclick='deleteRecipe(" . $recipe['recipe_id'] . ")'><i class='fas fa-trash-alt'></i>&nbsp&nbspDelete Recipe</button></div></div></div>";
    return $response;
}

function print_my_recipe_visitor($recipe) {
    $respnse = "<div class='div1'><div class='uploadRecipeCard'><a href='../controller/?action=view_recipe&id=" . $recipe['recipe_id'] . "'><img id='recipe_picture' src='data:image/jpeg;base64," . base64_encode($recipe['image_blob']) . "' height='120px' width='220px'/><br><br><h5 id='user_page_recipe_title'>" . $recipe['recipe_name'] . "</h5></a><br></div></div>";
    return $respnse;
}

function update_rating($recipe_id, $rating) {
    global $db;
    $query = "update recipe set rating = " . $rating . " where recipe_id = " . $recipe_id;
    echo $query;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

?>