<?php
$current = 'home';
include 'header.php';
include "../model/db_connect.php";
require "../user/user_db.php";


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
        
        if(user_id>=1)
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
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                    xmlhttp.open("GET", "../ticket/submitTicket.php?action=2&user_id="+<?php echo $id ?>+"&type="+type, true);
                    xmlhttp.send();
            }
            



</script>

<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <img id="profile_pic" >
        </div>

        <div class="col-lg-9">
            <h1><?php echo $user['username']; ?></h1>
            <h3>Bio:</h3>
            <h2>Liked Recipes</h2>
            <div id="favoriteRecipes">

            </div>
            
            <h2>Uploaded Recipes</h2>
            no posts yet :(
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

</body>

</html>
