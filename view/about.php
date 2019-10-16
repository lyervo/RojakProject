<?php

/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if (!isset($_SESSION['id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: ../login.php');
    exit;
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: ../login.php');
}

$current = 'about';
include 'header.php';
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-3">

            about

        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-9">

         

 

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
