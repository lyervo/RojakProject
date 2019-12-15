<?php
$current = 'user';
include 'header.php';
include '../user/editUser.php';
$user = getUserByID($_SESSION['user_id']);
?>





<script>
    
    function checkSize(file) 
    {
        var size = file.files[0].size / 1024 / 1024; 
        if (size > 0.5)
        {
            
            return false;

        } else
        {
            return true;
        }
    }
    
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
            return;
        }
        
        if(!checkSize(imageFileInput))
        {
            alert("File size must be less than 0.5 mb");
            return;
        }
        



        formData.append("user_id", <?php echo $user['user_id']; ?>);





        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
               alert("Profile picture successfully updated");
               location.reload();
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
        <div class="col-lg-8 formInput">

            <h2 style="color: #6666ff;"><i class="fas fa-user-cog"></i>&nbsp;Account Settings</h2>
            <br><br>
     

            <div class="profile_upload">
                Upload your profile picture: 
                <input type="file" name="image_file" id="image_file">
                <button class="btn btn-primary" onclick="uploadUserImage()">Upload Profile Image</button>
            </div>

            <br>
            
            <form action="" method="post" id="edit_form">

                <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>" />

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="<?php echo $user['username']; ?>"  >
                    </div>
                </div>
                

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" name="edit_user" value="Save Changes" class="btn btn-primary">
                        
                    </div>
                </div>
            </form>
            
            <br>

            <form action="" method="post" id="edit_form">

                <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>" />

               
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="<?php echo $user['email']; ?>" >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" name="edit_email" value="Save Changes" class="btn btn-primary">
                        
                    </div>
                </div>
            </form>

            <br>

            <form action="" method="post" id="edit_form">



                <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>" />
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
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
                        <input type="submit" name="edit_password" value="Save Changes" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <br><br>
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