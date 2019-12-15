<?php
$current = 'user';
include 'header.php';
include "../model/db_connect.php";
include '../recipe/recipe_db.php';

$recipe_id = $_REQUEST['recipe_id'];

$recipe = getRecipeByID($recipe_id);


$id = $_REQUEST['user_id'];

$user = getUserByID($id);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    init();





    var user_id;

    function init()
    {

        getLikedRecipes();
    }

    function getLikedRecipes()
    {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("favoriteRecipes").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../user/likedRecipe.php?user_id=" + <?php echo $id ?>, true);
        xmlhttp.send();

    }

    function checkLoginStatus(task)
    {

        if (user_id >= 1)
        {
            if (task === 1)
            {
                submitReportUser();
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
                        submitReportUser();
                    } else if (task === 0)
                    {
                        alert("run");
                        user_id = this.responseText;
                        uploadUserImage();
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

    function submitReportUser()
    {

        var type = document.getElementById("reportReasonUser").value;
        var detail = document.getElementById("report_textbox_user").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
                location.reload();
            }
        };
        xmlhttp.open("GET", "../ticket/submitTicket.php?action=2&recipe_id=0&review_id=0&user_id=" +<?php echo $id ?> + "&type=" + type + "&detail=" + detail, true);
        xmlhttp.send();
    }

    function deleteRecipe(recipe_id)
    {



        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                location.reload();
            }
        };
        xmlhttp.open("GET", "../ticket/deleteRecipe.php?recipe_id=" + recipe_id, true);
        xmlhttp.send();
    }

</script>

<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <?php
            if ($user['user_image'] == null) {
                echo '<img id="default_profile" src="../images/fbp.jpg" height="240px" width="240px" />';
            } else {
                echo '<img id="profile_picture" src="data:image/jpeg;base64,' . base64_encode($user['user_image']) . '" height="240px" width="240px"/>';
            }
            ?>

            <div class="edit_account">
                <?php
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['user_id'] == $user['user_id']) {
                        echo '<a href="../controller/?action=edit_user"><i class="fas fa-user-cog"></i> edit account</a>';
                    }
                }
                ?>

            </div>
            <br>

            <?php
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] != $user['user_id']) {
                    echo '<button id="report_recipe_button"><a role="button" data-toggle="modal" data-target="#report_recipe" ><i class="fas fa-flag"></i>&nbsp;Report this user</a></button>';
                }
            }
            ?>


            <div class="modal fade" id="report_recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">



                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <i style="font-size: 3em; color: red; text-align: center;" class='fas fa-flag'></i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                            </button>
                        </div>

                        <!-- Begin # DIV Form -->
                        <div id="div-forms">

                            <!-- Begin # Login Form -->

                            <div class="modal-body">
                                <h4 id="form_title_report">Report</h4>

                                <div style="border: 1px solid black;padding:5px" id="report_drop">
                                    <div id="targetedComment"></div>
                                    Report this user: 
                                    <select id="reportReasonUser">
                                        <option value='' selected disabled hidden>Select Reason</option>
                                        <option value="impersonation">Impersonation</option>
                                        <option value="profanity">Profanity</option>
                                        <option value="malicious link">Malicious Link</option>
                                        <option value="other">Other</option>

                                    </select>
                                    <br>
                                </div>

                                <input type="text" id="report_textbox_user" name="report_reason" placeholder="enter reason for report">

                            </div>
                            <div class="modal-footer">
                                <div>
                                    <input type="submit" name="report" value="Report" class="btn btn-danger" onclick="submitReportUser()">
                                </div>

                            </div>


                            <!-- End # Login Form -->


                            <!-- End | Register Form -->

                        </div>
                        <!-- End # DIV Form -->

                    </div>
                </div>
            </div>

        </div>
        <a id="top_button"></a>

        <div class="col-lg-9">
            <h1><?php echo $user['username']; ?></h1>
            <br>
            <h3 style="font-family: 'Courgette', cursive; color: #6666ff;">Uploaded Recipes</h3>

            <?php
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $user['user_id']) {
                    echo '<button class="btn btn-success"><a style="text-decoration: none; color: white;" href="../controller/?action=submit_recipe">Upload a recipe</a></button>';
                }
            }


            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $user['user_id']) {
                    include "../recipe/getUserListOfRecipe.php";
                } else {
                    include "../recipe/getUserListOfRecipeVisitor.php";
                }
            } else {
                include "../recipe/getUserListOfRecipeVisitor.php";
            }
            ?>
            <h3 style="font-family: 'Courgette', cursive; color: #6666ff;">Liked Recipes</h3>
            <div id="favoriteRecipes">

            </div>

            <div class="modal fade" id="delete_recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">



                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <i style="font-size: 3em; color: red; text-align: center;" class='fas fa-trash-alt'></i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                            </button>
                        </div>

                        <!-- Begin # DIV Form -->
                        <div id="div-forms">

                            <!-- Begin # Login Form -->

                            <div class="modal-body">
                                <h4 id="form_title_report">Sure you want to delete this recipe?</h4>





                            </div>
                            <div class="modal-footer">
                                <div>
                                    <?php echo "<button onclick='deleteRecipe(" . $recipe['recipe_id'] . ")' >click</button>" ?>
                                </div>

                            </div>


                            <!-- End # Login Form -->


                            <!-- End | Register Form -->

                        </div>
                        <!-- End # DIV Form -->

                    </div>
                </div>
            </div>

            <!-- onclick='deleteRecipe(" . $recipe['recipe_id'] . ")'-->
            <br>






        </div>
    </div>


</div>
<br><br><br>
<script>
    var btn = $('#top_button');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });
</script>

<?php
include 'footer.php';
?>

</body>

</html>
