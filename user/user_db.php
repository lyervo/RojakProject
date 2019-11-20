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

function getUserByName($username)
{
    global $db;
    $query = "select * from user where username = '".$username."'";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}


function create_user($username,$email,$password,$gender)
{
    global $db;
    $query = "insert into user values(null,'".$username."','".$email."','".$password."','".$gender."',null,0,0,null);";
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
    deleteUserReview($id);
}

function deleteUserReview($id)
{
    global $db;
    $query = "delete from review where user_id = ".$id;
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function deleteUserByName($name)
{
    global $db;
    $query = "delete from user where username = '".$name."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function setUserAdminByName($name)
{
    global $db;
    $query = "update user set admin = 1 where username = '".$name."'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function removeUserAdminByName($name)
{
    global $db;
    $query = "update user set admin = 0 where username = '".$name."'";
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


if (isset($_POST['edit_user'])) {


    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;


    $sql = "SELECT COUNT(email) AS num FROM user WHERE email = :email";
    $sql2 = "SELECT COUNT(username) AS num FROM user WHERE username = :username";

    $stmt = $db->prepare($sql);
    $stmt2 = $db->prepare($sql2);

    $stmt->bindValue(':email', $email);
    $stmt2->bindValue(':username', $username);


    $stmt->execute();
    $stmt2->execute();


    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);


    if ($row2['num'] > 0) {
        echo '<p id="reg_error">That username already exists!</p>';
    } else if ($row['num'] > 0) {
        echo '<p id="reg_error">That email already exists!</p>';
    } else {



        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));


        $sql3 = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";
        $stmt3 = $db->prepare($sql3);


        $stmt3->bindValue(':email', $email);
        $stmt3->bindValue(':username', $username);
        $stmt3->bindValue(':password', $passwordHash);


        $result = $stmt3->execute();


        if ($result) {

            echo '<p id="success">Thank you ' . $username . ', for registering with our website.</p>';
        }
    }
}


function add_user_image($user_id,$blob)
{
    global $db;
    $query = "update user set user_image = :blob where user_id = ".$user_id;
    $statement = $db->prepare($query);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->execute();
    $statement->closeCursor();
}

?>