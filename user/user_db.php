<?php

function getUserByID($user_id) {
    global $db;
    $query = "select * from user where user_id = " . $user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function getUserByIDPicture($user_id) {
    global $db;
    $query = "select * from user where user_id = " . $user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function getUserByName($username) {
    global $db;
    $query = "select * from user where username = '" . $username . "'";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function create_user($username, $email, $password, $gender) {
    global $db;
    $query = "insert into user values(null,'" . $username . "','" . $email . "','" . $password . "','" . $gender . "',null,0,0,null);";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteUser($id) {
    global $db;
    $query = "delete from user where user_id = " . $id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    deleteUserReview($id);
}

function deleteUserReview($id) {
    global $db;
    $query = "delete from review where user_id = " . $id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteUserByName($name) {
    global $db;
    $query = "delete from user where username = '" . $name . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function setUserAdminByName($name) {
    global $db;
    $query = "update user set admin = 1 where username = '" . $name . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function removeUserAdminByName($name) {
    global $db;
    $query = "update user set admin = 0 where username = '" . $name . "'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function getUserLikedRecipes($user_id) {
    global $db;
    $query = "SELECT * FROM 
            (recipe INNER JOIN 
            (likes INNER JOIN user ON likes.user_id = user.user_id)
            ON recipe.recipe_id = likes.recipe_id) WHERE user.user_id = " . $user_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}



function changeUsernameEmail($user_id, $username) {
    global $db;
    $query = "update user set username = :username where user_id = " . $user_id;
    $statement = $db->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->closeCursor();
}

function add_user_image($user_id, $blob) {
    global $db;
    $query = "update user set user_image = :blob where user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->bindParam(':user_id',$user_id);
    $statement->execute();
    $statement->closeCursor();
}

function getUserByReviewID($review_id) {
    global $db;
    $query = "select user.username,user.email from user inner join review on user.user_id = review.user_id where review.review_id = " . $review_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function getUserByRecipeID($recipe_id) {
    global $db;
    $query = "select user.username,user.email from user inner join recipe on user.user_id = recipe.author where recipe.recipe_id = " . $recipe_id;
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

?>