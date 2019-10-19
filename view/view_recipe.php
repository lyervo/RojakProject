<?php


$current = 'home';
include 'header.php';

include "../model/db_connect.php";
require "../recipe/recipe_db.php";


$id = $_REQUEST['id'];

$recipe = getRecipeByID($id);

$ingredients = getRecipeIngredientByID($id);

$steps = getStepByID($id);
?>

<script>
    var user_id;

    function checkLoginStatus(task)
    {
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
                    } else
                    {
                        user_id = this.responseText;
                        comment();
                    }
                } else
                {
                    alert("Please login to perform this action");
                }
            }
        };
        xmlhttp.open("GET", "../user/checkLoginStatus.php", true);
        xmlhttp.send();
    }

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
                    document.getElementById("likeButton").innerHTML = "Unlike";
                } else
                {
                    document.getElementById("likeButton").innerHTML = "Like";
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
                    document.getElementById("likeButton").innerHTML = "Unlike";

                } else
                {
                    document.getElementById("likeButton").innerHTML = "Like";
                }

                refreshLikes();
            }
        };
        xmlhttp.open("GET", "../like/like.php?recipe_id=" +<?php echo $id ?> + "&user_id=" + user_id, true);
        xmlhttp.send();


    }




</script>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-2">

            contact

        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-10">
            <h2>Recipe Name: <?php echo $recipe['recipe_name']; ?></h2>
            <p>Recommended Amount of Servings: <?php echo $recipe['serving'] ?></p>
            <p>Recipe Description :<?php echo $recipe['description'] ?></p>
            <p id="likes"></p>
            <br>
            <button onclick="checkLoginStatus(1)" id="likeButton">Like</button>



            <?php
            foreach ($ingredients as $ing) {
                $ingredient_name = getIngredientNameByID($ing['ingredient_id']);

                echo "<p>" . $ingredient_name . ", " . $ing['amount'];

                if ($ing['unit'] != "null") {
                    echo " " . $ing['unit'];
                }

                if ($ing['modifier'] != "null") {
                    echo "," . $ing['modifier'];
                }

                echo "</p>";
            }

            $num = 1;

            foreach ($steps as $step) {
                echo "<p>" . $num . ". " . $step['description'] . "</p>";
                $num += 1;
            }
            ?>

            <button onclick="checkLoginStatus(2)">Comment</button>
            <br>
            <textarea id="commentInput"></textarea>

            <div id="comments">Reviews</div>




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
