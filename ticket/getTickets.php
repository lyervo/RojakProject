<?php


    include "../model/db_connect.php";
    
    require "ticket_db.php";
    require "../review/review_db.php";
    
    $order = $_REQUEST['order'];
    
    $result = getTickets($order);
    
    $response = "";
    
    if(empty($result))
    {
        $response = "There is no ticket yet";
    }else
    {
        $response = "<table><tr><th>Type</th><th>Time Stamp</th><th>Link</th><th></th><th></th><th></th><tr>";
        foreach($result as $res)
        {

            $response = $response."<tr><td>".$res['ticket_type']."</td><td>".$res['date_submitted']."</td><td><a href='http://localhost/RojakProject/view_recipe.php".$res['link']."'>View Source</a></td>";
            
            $review_link = explode("review_", $res['link']);
            
            if($review_link[1]!=0)
            {
                $review = getReviewByID($review_link[1]);
            
                $response = $response."<td><a id='review_".$review['review_id']."'href='user_profile.php?user_id=".$review['user_id']."'>".$review['username']."</a><p>".$review['comment']."</p><i>".$review['review_date']."</i></td>";
            
                $response = $response."<td><button onclick='checkUserAdmin(".$review['review_id'].",1)'>Delete</button></td><td><button onclick='checkUserAdmin(".$res['ticket_id'].",2)'>Remove this report</button></td></tr>";
            }else
            {
                $response = $response."<td></td><td><button onclick='checkUserAdmin(".$res['recipe_id'].",6)'>Delete</button></td><td><button onclick='checkUserAdmin(".$res['ticket_id'].",2)'>Remove this report</button></td></tr>";
            }
            
            
            
            

        }
        $response = $response."</table>";
    }
    
    echo $response;