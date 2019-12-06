<?php

    function create_review($review,$user_id,$recipe_id,$rating)
    {
        global $db;
        $query = "insert into review values(".$user_id.",".$recipe_id.",null,'".$review."',".$rating.",null)";
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
        $query = "select review.user_id,review.review_id,review.comment,review.review_date,review.rating,user.username from (review inner join user on user.user_id = review.user_id) where review_id = ".$review_id." order by review_date desc";
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
    
    function deleteReviewByRecipeID($review_id)
    {
        global $db;
        $query = "delete from review where recipe_id=".$review_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function getReviewByUserIDRecipeID($user_id,$recipe_id)
    {
        
        global $db;
        $query = "select * from review where user_id = ".$user_id." and recipe_id = ".$recipe_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
        
    }
    
    function edit_review($review_id,$review,$rating)
    {
        global $db;
        $query = "update review set comment = '".$review."', rating = ".$rating." where review_id = ".$review_id;
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    
        

?>