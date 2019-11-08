<?php

    include "../model/db_connect.php";
    $sql = "SELECT * FROM images WHERE img_id = 1";
    $sth = $db->prepare($sql);
    $sth->execute();
    $result=$sth->fetch();
    $sth->closeCursor();
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['file_blob'] ).'"/>';