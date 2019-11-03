<?php

    include "model/db_connect.php";
    require "recipe/recipe_db.php";
    
    
    $id = $_REQUEST['id'];

    $recipe = getRecipeByID($id);
    
    $ingredients = getRecipeIngredientByID($id);
    
    $steps = getStepByID($id);
    
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $recipe['recipe_name']; ?></title>
    </head>
    <body onload="init()">
        <script>
            var user_id;
            
            var report_review_id;
            
            function initReport(id)
            {
                
                report_review_id = id;
                getTargetComment();
                document.getElementById("report_tab").style.display = "block";
            }
            
            function getTargetComment()
            {
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("targetedComment").innerHTML = this.responseText;
                   
                          
                        }
                    };
                    xmlhttp.open("GET", "review/getReviewByID.php?review_id="+report_review_id, true);
                xmlhttp.send();
                
                
            }
            
            
            function checkLoginStatus(task)
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText >= 1)
                            {
                                if(task===1)
                                {
                                    user_id = this.responseText;
                                    like();
                                }else if(task===2)
                                {
                                    user_id = this.responseText;
                                    comment();
                                }else if(task===3)
                                {
                                    user_id = this.responseText;
                                    submitReport();
                                }else if(task===4)
                                {
                                    user_id = this.responseText;
                                    submitReportRecipe();
                                }
                            }else
                            {
                                alert("Please login to perform this action");
                            }
                        }
                    };
                    xmlhttp.open("GET", "user/checkLoginStatus.php", true);
                    xmlhttp.send();
            }
            
            function init()
            {
                getTags();
                refreshComments();
                refreshLikes();
                
                setInterval(refreshComments, 5000);
                setInterval(refreshLikes,10000);
                checkLike();
            }
            
            function submitReport()
            {
                
                var type = document.getElementById("reportReason").value;
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                    xmlhttp.open("GET", "ticket/submitTicket.php?action=1&recipe_id="+<?php echo $id ?>+"&type="+type+"&review_id="+report_review_id, true);
                    xmlhttp.send();
            }
            
            function submitReportRecipe()
            {
                
                var type = document.getElementById("reportReasonRecipe").value;
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                    xmlhttp.open("GET", "ticket/submitTicket.php?action=1&recipe_id="+<?php echo $id ?>+"&type="+type+"&review_id=0", true);
                    xmlhttp.send();
            }
            
            function checkLike()
            {
                
                
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText == 1)
                            {
                                document.getElementById("likeButton").innerHTML = "Unlike";
                            }else
                            {
                                document.getElementById("likeButton").innerHTML = "Like";
                            }
                        }
                    };
                    xmlhttp.open("GET", "like/checkLiked.php?recipe_id="+<?php echo $id ?>+"&user_id="+<?php echo $_SESSION['user_id']; ?>, true);
                    xmlhttp.send();
            }
            
            function getTags()
            {
                
                
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                            document.getElementById("tag").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "recipe/get_recipe_tags.php?recipe_id="+<?php echo $id ?>, true);
                    xmlhttp.send();
            }
            
            function refreshLikes()
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("likes").innerHTML = this.responseText+" likes";
                        }
                    };
                    xmlhttp.open("GET", "like/getLikes.php?recipe_id="+<?php echo $id ?>, true);
                    xmlhttp.send();
            }
        
            function refreshComments()
            {
                
                console.log("Im upddating the comments");
                
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("comments").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "review/getReviews.php?recipe_id="+<?php echo $id ?>, true);
                    xmlhttp.send();
                
            }
            
            function comment()
            {
                
                var comment = document.getElementById("commentInput").value;
                
                if(comment.length === 0)
                {
                    
                }else
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            refreshComments();
                        }
                    };
               
                    xmlhttp.open("GET", "review/submit_comment.php?recipe_id="+<?php echo $id ?>+"&user_id="+user_id+"&review="+comment, true);
                    xmlhttp.send();
                }
            
            }
            
            function like()
            {
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText==1)
                            {
                                document.getElementById("likeButton").innerHTML = "Unlike";

                            }else
                            {
                                document.getElementById("likeButton").innerHTML = "Like";
                            }
                   
                            refreshLikes();
                        }
                    };
                    xmlhttp.open("GET", "like/like.php?recipe_id="+<?php echo $id ?>+"&user_id="+user_id, true);
                xmlhttp.send();
                
                
            }
            
            
        
        
        </script>
        
        <?php
        
            if($recipe['image_blob']==null)
            {
                echo "<p>This recipe has no image</p>";
            }else
            {
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $recipe['image_blob'] ).'"/>';
            }
        
        ?>
        <h2>Recipe Name: <?php echo $recipe['recipe_name']; ?></h2>
        <p>Recommended Amount of Servings: <?php echo $recipe['serving'] ?></p>
        <p>Recipe Description :<?php echo $recipe['description'] ?></p>
        <p id="likes"></p>
        <br>
        <button onclick="checkLoginStatus(1)" id="likeButton">Like</button>
        
        <div id="tag"></div>
        
        Report this recipe: 
            <select id="reportReasonRecipe" onchange='checkLoginStatus(4)'>
                <option value='' selected disabled hidden>Select Reason</option>
                <option value="missing allergen">Missing allergen</option>
                <option value="incorrect recipe">Incorrect recipe</option>
            </select>
        
        
        <?php
        
            foreach($ingredients as $ing)
            {
                $ingredient_name = getIngredientNameByID($ing['ingredient_id']); 
                
                echo "<p>".$ingredient_name.", ".$ing['amount'];
                
                if($ing['unit']!="null")
                {
                    echo " ".$ing['unit'];
                }
                
                if($ing['modifier']!="null")
                {
                    echo ",".$ing['modifier'];
                }
                        
                echo "</p>";
                
            }
            
            $num = 1;
            
            foreach($steps as $step)
            {
                echo "<p>".$num.". ".$step['description']."</p>";
                if($step['step_image']==null)
                {

                }else
                {
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $step['step_image'] ).'"/>';
                }
                $num += 1;
            }
        
        
        ?>
        
        <div style="display:none;border: 1px solid black;padding:5px" id="report_tab">
            <div id="targetedComment"></div>
            Report this comment: 
            <select id="reportReason" onchange='checkLoginStatus(3)'>
                <option value='' selected disabled hidden>Select Reason</option>
                <option value="profanity">Profanity</option>
            </select>
            <br>
        </div>
        
        
        <button onclick="checkLoginStatus(2)">Comment</button>
        <br>
        <textarea id="commentInput"></textarea>
        
        <div id="comments">Reviews</div>
        
        
    </body>
</html>
