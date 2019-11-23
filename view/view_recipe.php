<?php
$current = 'home';
include 'header.php';

include "../model/db_connect.php";
require "../recipe/recipe_db.php";

$id = $_REQUEST['id'];

$recipe = getRecipeByID($id);

$ingredients = getRecipeIngredientByID($id);

$steps = getStepByID($id);

$user = getUserByID($recipe['author']);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    init();

    var user_id;



    function init()
    {
        refreshComments();
        refreshLikes();

        setInterval(refreshComments, 5000);
        setInterval(refreshLikes, 10000);
        checkLike();
    }

    function checkLike()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText == 1)
                {
                    document.getElementById("likeButton").innerHTML = "<i class='fas fa-heart'></i>";
                } else
                {
                    document.getElementById("likeButton").innerHTML = "<i class='far fa-heart'></i>";
                }
            }
        };
        xmlhttp.open("GET", "../like/checkLiked.php?recipe_id=" +<?php echo $id ?> + "&user_id=" + 1, true);
        xmlhttp.send();
    }

    function refreshLikes()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("likes").innerHTML = this.responseText + " likes";
            }
        };
        xmlhttp.open("GET", "../like/getLikes.php?recipe_id=" +<?php echo $id ?>, true);
        xmlhttp.send();
    }

    function refreshComments()
    {

        console.log("Im upddating the comments");

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("comments").innerHTML = this.responseText;

            }
        };
        xmlhttp.open("GET", "../review/getReviews.php?recipe_id=" +<?php echo $id ?>, true);
        xmlhttp.send();

    }

    function comment()
    {

        var comment = document.getElementById("commentInput").value;

        if (comment.length === 0)
        {

        } else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    refreshComments();
                }
            };

            xmlhttp.open("GET", "../review/submit_comment.php?recipe_id=" +<?php echo $id ?> + "&user_id=" + user_id + "&review=" + comment, true);
            xmlhttp.send();
        }

    }

    function like()
    {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText == 1)
                {
                    document.getElementById("likeButton").innerHTML = "<i class='fas fa-heart'></i>";

                } else
                {
                    document.getElementById("likeButton").innerHTML = "<i class='far fa-heart'></i>";
                }

                refreshLikes();
            }
        };
        xmlhttp.open("GET", "../like/like.php?recipe_id=" +<?php echo $id ?> + "&user_id=" + user_id, true);
        xmlhttp.send();


    }

    var user_id;

    function checkLoginStatus(task)
    {

        if (user_id >= 1)
        {
            if (task === 1)
            {

                like();
            } else if (task === 2)
            {

                comment();
            } else if (task === 3)
            {

                submitReportComment();
            } else if (task === 4)
            {

                submitReportRecipe();
            }
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText >= 1)
                {
                    if (task === 1)
                    {
                        user_id = this.responseText;
                        like();
                    } else if (task === 2)
                    {
                        user_id = this.responseText;
                        comment();
                    } else if (task === 3)
                    {
                        user_id = this.responseText;
                        submitReportComment();
                    } else if (task === 4)
                    {
                        user_id = this.responseText;
                        submitReportRecipe();
                    }


                } else
                {
                    alert("Sorry, you need to login to perform this action.");
                    $('#login-modal').modal('show');
                }
            }
        };
        xmlhttp.open("GET", "../user/checkLoginStatus.php", true);
        xmlhttp.send();
    }

    function submitReportComment()
    {

        var type = document.getElementById("reportReason").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "../ticket/submitTicket.php?action=1&recipe_id=" +<?php echo $id ?> + "&type=" + type + "&review_id=" + report_review_id, true);
        xmlhttp.send();
    }

    function submitReportRecipe()
    {

        var type = document.getElementById("reportReasonRecipe").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "../ticket/submitTicket.php?action=1&recipe_id=" +<?php echo $id ?> + "&type=" + type + "&review_id=0", true);
        xmlhttp.send();
    }

    var report_review_id;

    function initReport(id)
    {

        report_review_id = id;
        //getTargetComment();
        //document.getElementById("report_tab").style.display = "block";
    }

    function getTargetComment()
    {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("targetedComment").innerHTML = this.responseText;


            }
        };
        xmlhttp.open("GET", "../review/getReviewByID.php?review_id=" + report_review_id, true);
        xmlhttp.send();


    }


</script>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-4">

            <?php
            if ($recipe['image_blob'] == null) {
                echo "<p>This recipe has no image</p>";
            } else {
                echo '<img id="recipe_picture" src="data:image/jpeg;base64,' . base64_encode($recipe['image_blob']) . '" height="280px" width="400px"/>';
            }
            ?>

            <button id="likeButton" onclick="checkLoginStatus(1)"></button>
            <p id="likes"></p>
            <a href="#comments">write a review</a>
            <br><br>
            <button id="report_recipe_button"><a role='button' data-toggle='modal' data-target='#report_recipe' ><i class='fas fa-flag'></i>&nbsp;Report this recipe</a></button> 

            <div class="modal fade" id="report_recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">



                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <img class="img-circle" id="img_logo" src="../images/logo.jpg">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                            </button>
                        </div>

                        <!-- Begin # DIV Form -->
                        <div id="div-forms">

                            <!-- Begin # Login Form -->
                            <form action="" method="post">
                                <div class="modal-body">
                                    <h4 id="form_title_report">Report</h4>

                                    <div style="border: 1px solid black;padding:5px" id="report_drop">
                                        <div id="targetedComment"></div>
                                        Report this recipe: 
                                        <select id="reportReasonRecipe" >
                                            <option value='' selected disabled hidden>Select Reason</option>
                                            <option value="missing allergen">Missing allergen</option>
                                            <option value="incorrect recipe">Incorrect recipe</option>
                                            <option value="duplicate recipe">Duplicate recipe</option>
                                            <option value="malicious links">Malicious links</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <br>
                                    </div>

                                    <input type="text" id="report_textbox" name="report_reason" placeholder="enter reason for report">

                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <input type="submit" name="report" value="Report" class="btn btn-danger">
                                    </div>

                                </div>

                            </form>
                            <!-- End # Login Form -->


                            <!-- End | Register Form -->

                        </div>
                        <!-- End # DIV Form -->

                    </div>
                </div>
            </div>
            <br><br>
            <h5>Ingredents:</h5>
            <?php
            
            $table = "<table id='ing_table'><tr><th>Ingredent</th><th>Unit</th></tr>";
            
            foreach ($ingredients as $ing) {
                $ingredient_name = getIngredientNameByID($ing['ingredient_id']);

                $table = $table . "<tr><td>" . $ingredient_name . "</td><td> " . $ing['amount'] . " ";

                if ($ing['unit'] != "null") {
                    $table = $table . $ing['unit'];
                }

                if ($ing['modifier'] != "null") {
                    $table = $table . $ing['modifier'];
                }

                $table = $table . "</td></tr>";
                
            }
            $table = $table . "</table>";
            echo $table;
            ?>
            <br><br>
            <p>Servings: <?php echo $recipe['serving'] ?></p>

        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-8">

            <h2><?php echo $recipe['recipe_name']; ?></h2>
            <p>By <?php echo "<a href='?action=user_profile&user_id=" . $user['user_id'] . "'>" . $user['username'] . "</a>" ?>

            <p><?php echo $recipe['description'] ?></p>



            <br>
            <div id="sharing_plugins">
                <div class="fb-share-button" data-href="http://127.0.0.1/RojakProject/view/view_recipe.php?id=<?php echo $id; ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

            </div>
            <br>

            






            <h5>Method</h5>
            <?php
            $num = 1;

            foreach ($steps as $step) {
                echo "<p>" . $num . ". " . $step['description'] . "</p>";
                if ($step['step_image'] == null) {
                    
                } else {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($step['step_image']) . '" height="40px"/><br>';
                }
                $num += 1;
            }
            ?>

            <a href="#"><i class="fab fa-youtube"></i>Click here for a video Tutorial</a>

            <br><br>






            <div class="modal fade" id="report_tab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">



                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <img class="img-circle" id="img_logo" src="../images/logo.jpg">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                            </button>
                        </div>

                        <!-- Begin # DIV Form -->
                        <div id="div-forms">

                            <!-- Begin # Login Form -->
                            <form action="" method="post">
                                <div class="modal-body">
                                    <h4 id="form_title_report">Report</h4>

                                    <div style="border: 1px solid black;padding:5px" id="report_drop">
                                        <div id="targetedComment"></div>
                                        Report this comment: 
                                        <select id="reportReason">
                                            <option value='' selected disabled hidden>Select Reason</option>
                                            <option value="profanity">Profanity</option>
                                            <option value="advertisement">Advertisement</option>
                                            <option value="malicious link">Malicious Link</option>
                                            <option value="other">Other</option>

                                        </select>
                                        <br>
                                    </div>

                                    <input type="text" id="report_textbox" name="report_reason" placeholder="enter reason for report">

                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <input type="submit" name="report" value="Report" class="btn btn-danger">
                                    </div>

                                </div>

                            </form>
                            <!-- End # Login Form -->


                            <!-- End | Register Form -->

                        </div>
                        <!-- End # DIV Form -->

                    </div>
                </div>
            </div>

            <div class="comment_section">
                <div class="comment_contain">
                    <div id="comments">Reviews</div>
                </div>

                <textarea placeholder="write a comment..." id="commentInput"></textarea>
                <br>
                <button id="comment_button" class="btn btn-info" onclick="checkLoginStatus(2)" >Comment</button>
                <br><br>
            </div> 

            <br>

            <h2>Simular Recipes</h2>
            ...
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
include 'footer.php';
?>

</body>

</html>
