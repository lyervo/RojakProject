<?php
    include "../model/db_connect.php";

    if(isset($_FILES['file']))
    {
        $filePath = $_FILES['file']['tmp_name'];
        $name = $_POST['name'];
        echo $name;
        $blob = fopen($filePath, 'rb');
 
        $sql = "INSERT INTO images VALUES(null,:name,:data)";
        $stmt = $db->prepare($sql);
 
        $stmt->bindParam(':name', $_FILES['file']['name']);
        $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
 
        $stmt->execute();
    }else
    {
        echo "not rdy";
    }