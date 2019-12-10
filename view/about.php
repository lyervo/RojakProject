<?php
$current = 'about';
include 'header.php';
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-3">
            <div id="aboutUsTitle">
            <h1>About Us</h1>
            </div>
        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel" >
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                        
                    </li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1">
                        
                        
                    </li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2">
                        
                        
                    </li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="../images/p1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="../images/sliderImage2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="../images/sliderImage3.jpg" alt="Third slide">
                    </div>
                    
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
        <div class="col-lg-6">
            
                <img src="../images/Unimeals.jpg" class="unimealsDescription" alt=""/>
                
                <div class="decriptionText">
                    Unimeals was started because we felt there isn't enough places for 
                students to get healthy recipes so we set out with the aim to do just that!
                At Unimeals you can find all the easy to make healthy meals you could want, but thats 
                not all, with our upload system there's always something new for you to check out
                </div>
            <br><br><br><br><br><br>
        </div>
        <div class="col-lg-6">
            
            <img src="../images/Rojak.png" class="rojakDescription" alt=""/>
            <br><br>
            <div class="decriptionText">
                Rojak Ltd. started in 1909 as a 
                local food store in Ireland, blackrock and 
                has just celebrated its 110th birthday! 
                so we must be doing something right. 
                Its goal is the same today as it was back then, 
                to provide healthy food to everyone we can.
            </div>
            <br><br><br><br><br><br>
        </div>
        <div class="col-lg-3">
            
                <div class="user-info1">
                    <div class="profile-pic">

                        <div class="displayedImage1"></div>
                        <img src="../images/profilePicture1.jpg" alt=""/>
                        
                    </div>
                    <div class="aboutText">
                        Francis - Head Chief
                        <br>
                        Cooks the best dishes. We dare you to find better ones!
                    </div>
                </div>
        </div>
            <div class="col-lg-3">
                <div class="user-info2">
                    <div class="profile-pic">

                        <div class="displayedImage1"></div>
                        <img src="../images/profilePicture4.jpg" alt=""/>
                        <div class="layer">
                           
                        </div><a class="image-wrapper" href="#">
                            <form id="profilePictureForm" action="#">
                            </form></a>
                    </div>
                    <div class="aboutText">
                        Thomas - Lead Designer 
                        <br>
                        Comes up with the best and craziest recipes!
                    </div>
                </div>
        </div>
         <div class="col-lg-3">
                <div class="user-info3">
                    <div class="profile-pic">

                        <div class="displayedImage1"></div>
                        <img src="../images/CA2Persona1Edit.jpg" alt=""/>
                        <div class="layer">
                           
                        </div><a class="image-wrapper" href="#">
                            <form id="profilePictureForm" action="#">
                            </form></a>
                    </div>
                    <div class="aboutText">
                        Timothy - Chief
                        <br>
                        Helps make everything we come up with!
                    </div>
                </div>
         </div>
         <div class="col-lg-3">
            <div class="user-info4">
                    <div class="profile-pic">

                        <div class="displayedImage1"></div>
                        <img src="../images/profilePic5Edit.jpg" alt=""/>
                        <div class="layer">
                           
                        </div><a class="image-wrapper" href="#">
                            <form id="profilePictureForm" action="#">
                            </form></a>
                    </div>
                    <div class="aboutText">
                        Josh - Food Taster
                        <br>
                        Makes sure only the best comes from us!
                    </div>
                </div>
            

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->
<br><br><br>
</div>
<!-- /.container -->

<?php
include 'footer.php';
?>

</body>

</html>
