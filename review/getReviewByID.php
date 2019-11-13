<?php

    include "../model/db_connect.php";
    
    require 'review_db.php';
    require '../user/user_db.php';
    
    $review_id = $_REQUEST['review_id'];
    $res = getReviewByID($review_id);
    
    
    


    $response = "<a id='review_".$res['review_id']."'href='user_profile.php?user_id=".$res['user_id']."'>".$res['username']."</a><p>".$res['comment']."</p><i>".$res['review_date']."</i>";
    
    echo $response;