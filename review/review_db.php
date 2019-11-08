<?php

    function create_review($review,$user_id,$recipe_id)
    {
        global $db;
        $query = "insert into review values(".$user_id.",".$recipe_id.",null,'".$review."',null)";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    function getReviews($recipe_id)
    {
        global $db;
        $query = "select * from review where recipe_id = ".$recipe_id." order by review_date desc";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    
    function getReviewByID($review_id)
    {
        global $db;
        $query = "select review.user_id,review.review_id,review.comment,review.review_date,user.username from (review inner join user on user.user_id = review.user_id) where review_id = ".$review_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
    
    function deleteReviewByID($review_id)
    {
        global $db;
        $query = "delete from review where review_id=".$review_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    

?>