<?php


session_start();

if (!isset($_SESSION['log_user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: ../view/index.php');
    exit;
}

$current = 'home';
include 'header.php';

?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-3">

            <input type="text" id="term"><button onclick="searchRecipe()">Search</button><br>

            <p>Must have:</p>
            <input type="checkbox" value="vegan" class="tag">Vegan<br>
            <input type="checkbox" value="halal" class="tag">Halal<br>
            <input type="checkbox" value="kosher" class="tag">Kosher<br>


            <p>Exclude:</p>
            <input type="checkbox" value="no_wheat" class="noTag">Wheat<br>
            <input type="checkbox" value="no_crustacean" class="noTag">Crustaceans<br>
            <input type="checkbox" value="no_egg" class="noTag">Egg<br>
            <input type="checkbox" value="no_fish" class="noTag">Fish<br>
            <input type="checkbox" value="no_peanut" class="noTag">Peanuts<br>
            <input type="checkbox" value="no_soy" class="noTag">Soy<br>
            <input type="checkbox" value="no_milk" class="noTag">Milk<br>
            <input type="checkbox" value="no_nuts" class="noTag">Nuts<br>
            <input type="checkbox" value="no_celery" class="noTag">Celery<br>
            <input type="checkbox" value="no_mustard" class="noTag">Mustard<br>
            <input type="checkbox" value="no_sesame" class="noTag">Sesame<br>
            <input type="checkbox" value="no_shellfish" class="noTag">Shellfish<br>

            Sort by 
            <select id="sort">
                <option value="name">Name</option>
                <option value="date">Submitted Date</option>
                <option value="rating">User Rating</option>
                <option value="time">Cooking Time</option>

            </select>
            <select id="order">
                <option value="asc">Ascending Order</option>
                <option value="desc">Descending Order</option>
            </select>

             
             
        
        
        

        
        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->

       
        <div class="col-lg-9">

            <div id="result"></div>




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
