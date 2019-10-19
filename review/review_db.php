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

?>