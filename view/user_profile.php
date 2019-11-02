<?php
include "../model/db_connect.php";
require "../user/user_db.php";

$current = 'home';
include 'header.php';

$id = $_REQUEST['user_id'];

$user = getUserByID($id);
?>


<!--<head>
    <title><?php echo $user['username']; ?></title>
</head>-->

<script>

    init();

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
        xmlhttp.open("GET", "../user/likedRecipe.php?user_id=" + 1, true);
        xmlhttp.send();

    }



</script>

<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <img width="300px" height="300px">
        </div>

        <div class="col-lg-9">
            <h1><?php echo $user['username']; ?></h1>
            <h2>Liked Recipes</h2>
            <div id="favoriteRecipes">

            </div>
        </div>
    </div>
</div>

<?php
//include 'footer.php';
?>

</body>

</html>
