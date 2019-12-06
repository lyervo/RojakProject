<?php

include '../model/db_connect.php';

if (isset($_POST['edit_user'])) {

    global $db;
    
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $user_id = !empty($_POST['id']) ? trim($_POST['id']) : null;
    
    $sql2 = "SELECT COUNT(username) AS num FROM user WHERE username = :username";

    $stmt2 = $db->prepare($sql2);

    $stmt2->bindValue(':username', $username);

    $stmt2->execute();

    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($row2['num'] > 0) {
        echo '<p id="reg_error">That username already exists! id = '.$user_id.'</p>';
    }  else {

        $sql4 = "UPDATE user SET username = :username WHERE user_id =".$user_id;
        $stmt4 = $db->prepare($sql4);

        $stmt4->bindValue(':username', $username);

        $result = $stmt4->execute();

        if ($result) {

            echo '<div id="reg_success"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-check-circle"></i><br><br>Your changes have been applied.</div>';
        }
    }
}

if (isset($_POST['edit_email'])) {

    global $db;
    
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $user_id = !empty($_POST['id']) ? trim($_POST['id']) : null;
    
    $sql2 = "SELECT COUNT(email) AS num FROM user WHERE email = :email";

    $stmt2 = $db->prepare($sql2);

    $stmt2->bindValue(':email', $email);

    $stmt2->execute();

    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($row2['num'] > 0) {
        echo '<p id="reg_error">That email already exists! id = '.$user_id.'</p>';
    }  else {

        $sql4 = "UPDATE user SET email = :email WHERE user_id =".$user_id;
        $stmt4 = $db->prepare($sql4);

        $stmt4->bindValue(':email', $email);

        $result = $stmt4->execute();

        if ($result) {

            echo '<div id="reg_success"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-check-circle"></i><br><br>Your changes have been applied.</div>';
        }
    }
}

if (isset($_POST['edit_password'])) {

    global $db;
    
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $confirm_password = !empty($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;
    $user_id = !empty($_POST['id']) ? trim($_POST['id']) : null;
    
//    $sql2 = "SELECT COUNT(email) AS num FROM user WHERE email = :email";
//
//    $stmt2 = $db->prepare($sql2);
//
//    $stmt2->bindValue(':email', $email);
//
//    $stmt2->execute();
//
//    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($password != $confirm_password) {
        echo '<p id="reg_error">Passwords do not match! id = '.$user_id.'</p>';
    }  else {
        
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $sql4 = "UPDATE user SET password = :password WHERE user_id =".$user_id;
        $stmt4 = $db->prepare($sql4);

        $stmt4->bindValue(':password', $passwordHash);

        $result = $stmt4->execute();

        if ($result) {

            echo '<div id="reg_success"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-check-circle"></i><br><br>Your changes have been applied.</div>';
        }
    }
}
?>

