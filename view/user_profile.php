<?php
$current = 'user';
include 'header.php';
include "../model/db_connect.php";
require "../user/user_db.php";


$id = $_REQUEST['user_id'];

$user = getUserByID($id);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    init();
    
    function uploadUserImage()
    {
        
        
        
        var formData = new FormData();
        
        var imageFileInput = document.getElementById('image_file');
        if (imageFileInput.value.length > 0)
        {
            var image_file = imageFileInput.files[0];

            formData.append('image_file', image_file, "user_image");
        }else
        {
            alert("Please provide an image");
        }
        
        
        
        formData.append("user_id",user_id);





        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.onload = function ()
        {
            insertIngredientStep(this.responseText);
        };
        xmlhttp.open("POST", "../user/uploadUserImage.php", true);
        xmlhttp.send(formData);



    }
    


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
                    }else if(task === 0)
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

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "../ticket/submitTicket.php?action=2&user_id=" +<?php echo $id ?> + "&type=" + type, true);
        xmlhttp.send();
    }




</script>

<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <?php
        if ($user['user_image'] == null) {
               
            } else {
                echo '<img id="recipe_picture" src="data:image/jpeg;base64,' . base64_encode($user['user_image']) . '" height="280px" width="400px"/>';
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

        </div>
        
        
        <div class="col-lg-9">
            <h1><?php echo $user['username']; ?></h1>
            <h3>Bio:</h3>
            <h2>Liked Recipes</h2>
            <div id="favoriteRecipes">

            </div>

            <h2>Uploaded Recipes</h2>
            no posts yet :(
            <?php
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $user['user_id']) {
                    echo '<button><a href="../controller/?action=submit_recipe">Upload a recipe</a></button>';
                }
            }
            ?>
            <br>
            Upload your profile
             <input type="file" name="image_file" id="image_file">
             <button onclick='checkLoginStatus(0)'>Upload Profile Image</button>

            Report this user: 
            <select id="reportReasonUser" onchange='checkLoginStatus(1)'>
                <option value='' selected disabled hidden>Select Reason</option>
                <option value="illegal content">Illegal content</option>
                <option value="impersonation">Impersonation</option>
                <option value="malicious link">Malicious Link</option>
                <option value="other">Other</option>

            </select>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

</body>

</html>
