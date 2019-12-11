<?php


    include "../model/db_connect.php";
    
    require "ticket_db.php";
    require "../review/review_db.php";
    
    require "../user/user_db.php";
    
    require 'mailto_format.php';
    
    $order = $_REQUEST['order'];
    
    
    
    $response = "";
    
    $type = $_REQUEST['type'];
   
    $asc  = $_REQUEST['asc'];
    
    $content = $_REQUEST['content'];
    
    
    $result = getTickets($order,$type,$content,$asc);
    
    if(empty($result))
    {
        $response = "There is no ticket yet";
    }else
    {
        $response = "<table><tr><th>Content</th><th>Type</th><th>Detail</th><th>Time Stamp</th><th>Link</th><th>Comment Preview</th><th>Delete Content</th><th>Delete Report</th><th>Send Mail Warning</th><th>Overdue?</th><th>Deadline</th><tr>";
        foreach($result as $res)
        {
            $content;
            $user;
            if($res['user_id'] != 0)
            {
                $user = getUserByID($res['user_id']);
                $content = "User";
            }else if($res['review_id'] != 0)
            {
                $user = getUserByReviewID($res['review_id']);
                $content = "Comment";
            } else 
            {
                $user = getUserByRecipeID($res['recipe_id']);
                $content = "Recipe";
            }
            
            $mail = createMailLink($res, $user);
            
            
            
            if($res['recipe_id']==0&&$res['review_id']==0)
            {
                $response = $response."<tr><td>".$content."</td><td>".$res['ticket_type']."</td><td>".$res['detail']."</td><td>".$res['date_submitted']."</td><td><a href='".$res['link']."'>View Source</a></td>";
                
                $response = $response."<td></td><td><button onclick='checkUserAdmin(".$res['user_id'].",10)'>Delete User</button></td><td><button onclick='checkUserAdmin(".$res['ticket_id'].",2)'>Remove this report</button></td><td>".$mail."</td><td>".$res['deadline_info']."</td><td>".$res['deadline']."</td></tr>";
                
            } else
            {
                
                $response = $response."<tr><td>".$content."</td><td>".$res['ticket_type']."</td><td>".$res['detail']."</td><td>".$res['date_submitted']."</td><td><a href='".$res['link']."'>View Source</a></td>";
            
                
                    if($res['review_id'] != 0)
                    {
                        $review = getReviewByID($res['review_id']);
                        
                        $response = $response."<td><a id='review_".$review['review_id']."'href='user_profile.php?user_id=".$review['user_id']."'>".$review['username']."</a><p>".$review['comment']."</p><i>".$review['review_date']."</i></td>";

                        $response = $response."<td><button onclick='checkUserAdmin(".$review['review_id'].",1)'>Delete</button></td><td><button onclick='checkUserAdmin(".$res['ticket_id'].",2)'>Remove this report</button></td><td>".$mail."</td><td>".$res['deadline_info']."</td><td>".$res['deadline']."</td></tr>";
                    }else
                    {
                         $response = $response."<td></td><td><button onclick='checkUserAdmin(".$res['recipe_id'].",6)'>Delete</button></td><td><button onclick='checkUserAdmin(".$res['ticket_id'].",2)'>Remove this report</button></td><td>".$mail."</td><td>".$res['deadline_info']."</td><td>".$res['deadline']."</td></tr>";

                    }

                
                
            }
            
            
            
            
            

        }
        $response = $response."</table>";
    }
    
    echo $response;