<?php

    include "db_connect.php";
    
    $query = 'SELECT ROUND(SUM(index_length + data_length) / 1024 / 1024, 1) as "size" 
            FROM information_schema.tables 
            WHERE table_schema = "udp"
            GROUP BY table_schema'; 
    
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    
    if(empty($result))
    {
        echo -1;
    }else
    {
        echo $result['size'];
    }