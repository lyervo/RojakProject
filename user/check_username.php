<?php
    include "../db_connect.php";
    
    
    
    $username = $_REQUEST["username"];
    
    
    
    $query = "select username from user";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    
    $response = "Valid user name.";
    
    if ($username !== "")
    {


        foreach($results as $res) {
            if ($res["username"] === $username) {
                $response = "Duplicate user name,please use a different name.";

            }
        }
    }
    echo $response;
?>