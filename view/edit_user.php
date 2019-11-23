<?php
$current = 'home';
include 'header.php';

$user = getUserByID($_SESSION['user_id']);
?>





<script>
    function uploadUserImage()
    {



        var formData = new FormData();

        var imageFileInput = document.getElementById('image_file');
        if (imageFileInput.value.length > 0)
        {
            var image_file = imageFileInput.files[0];

            formData.append('image_file', image_file, "user_image");
        } else
        {
            alert("Please provide an image");
        }



        formData.append("user_id", user_id);





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
</script>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-10">


            <form action="" method="post">

                Upload your profile
                <input type="file" name="image_file" id="image_file">
                <button onclick='checkLoginStatus(0)'>Upload Profile Image</button>
                
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="<?php echo $user['username']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="<?php echo $user['email']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="confirm_password" class="form-control" id="inputEmail3" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" name="edit_user" value="Save Changes" class="btn login_btn">
                    </div>
                </div>
            </form>

        </div>
        <!-- /.col-lg-3 -->


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