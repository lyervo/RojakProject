<?php

    include "../model/db_connect.php";
   
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>UniMeals</title>



        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="../css/footer.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!--login-->
        <script src="../JS/login.js" type="text/javascript"></script>
        <link href="../css/login_style.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>

        <script src="../JS/JavaScript.js" type="text/javascript"></script>

    </head>

    <body onload="checkLoginAdminStatus()">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
            <div class="container">
                <a class="navbar-brand" href="?action=home">UniMeals</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/?action=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/?action=about">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="login_button"  role="button" data-toggle="modal" data-target="#login-modal">Login/Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br><br>
        
        
                        </div>
                    </div>
                </div>-->

        <?php
        require '../login_session/session.php';
        ?>

        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <img class="img-circle" id="img_logo" src="../images/logo.jpg">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                        </button>
                    </div>

                    <!-- Begin # DIV Form -->
                    <div id="div-forms">

                        <!-- Begin # Login Form -->
                        <form action="../controller/" method="post" id="login-form">
                            <div class="modal-body">
                                <div id="div-login-msg">
                                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-login-msg">Type your username and password.</span>
                                </div>
                                <input  id="login_username" class="form-control" type="text" name="username" placeholder="Username" required>
                                <input id="login_password" class="form-control" type="password" name="password" placeholder="Password" required>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <input type="submit" name="Login" value="Login" class="btn login_btn">
                                </div>
                                <div>
                                    <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                                    <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                                </div>
                            </div>
                        </form>
                        <!-- End # Login Form -->

                        <!-- Begin | Lost Password Form -->
                        <form id="lost-form" style="display:none;">
                            <div class="modal-body">
                                <div id="div-lost-msg">
                                    <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-lost-msg">Type your e-mail.</span>
                                </div>
                                <input id="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                                </div>
                                <div>
                                    <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                                    <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                                </div>
                            </div>
                        </form>
                        <!-- End | Lost Password Form -->

                        <!-- Begin | Register Form -->
                        <form action="../controller/" method="post" id="register-form" style="display:none;">
                            <div class="modal-body">
                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Register an account.</span>
                                </div>
                                <input id="register_username" class="form-control" type="text" name="username" placeholder="Username" required>
                                <input id="register_email" class="form-control" type="email" name="email" placeholder="E-Mail" required>
                                <input id="register_password" class="form-control" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <input type="submit" name="register" value="Register" class="btn login_btn">

                                </div>
                                <div>
                                    <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                                    <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                                </div>
                            </div>
                        </form>
                        <!-- End | Register Form -->

                    </div>
                    <!-- End # DIV Form -->

                </div>
            </div>
        </div>
        <style>
            table 
            {
                border-collapse: collapse;
            }

            table, th, td
            {
                border: 1px solid black;
            }
            
            th
            {
                text-align: center;
                padding: 10px;
            }
            
            td
            {
                text-align: center;
                padding: 5px;
            }
            
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
          
          var user_id;
          
            function checkLoginAdminStatus()
            {
                
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText >= 1)
                            {
                                user_id = this.responseText;
                                
                                getTickets();
                                getDatabaseStats();
                            }else
                            {
                                alert("You must have admin status to view this page.");
                                window.location.href = "search.html";
                            }
                        }
                    };
                    xmlhttp.open("GET", "../user/checkLoginAdminStatus.php", true);
                    xmlhttp.send();
            }
          
          
            function getTickets()
            {
 
                var type = document.getElementById("type").value;
                var content = document.getElementById("content").value;
                var order = document.getElementById("report_order").value;
                var sort = document.getElementById("report_sort").value;
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("tickets").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../ticket/getTickets.php?order="+sort+"&asc="+order+"&content="+content+"&type="+type, true);
                    xmlhttp.send();
            
            }
            
            function setUserStatus(action)
            {
 
                var username = document.getElementById("usernameInput").value;
                

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                    xmlhttp.open("GET", "../user/setUserStatus.php?username="+username+"&action="+action, true);
                    xmlhttp.send();
            
            }
            
            function deleteComment(id)
            {
 
                alert("wdfghj");
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                            getTickets();
                        }
                    };
                    xmlhttp.open("GET", "../ticket/deleteReview.php?recipe_id=0&review_id="+id, true);
                    xmlhttp.send();
            
            }
            
            function deleteRecipe(id)
            {
 
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                            getTickets();
                        }
                    };
                    xmlhttp.open("GET", "../ticket/deleteReview.php?review_id=0&recipe_id="+id, true);
                    xmlhttp.send();
            
            }
            
            function deleteUser(id)
            {
 
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert("Action Completed");
                            getTickets();
                        }
                    };
                    xmlhttp.open("GET", "../ticket/deleteUser.php?user_id="+id, true);
                    xmlhttp.send();
            
            }
            
            function deleteUsersByStrikes()
            {
                var strikes = document.getElementById("strikes").value;
                if(strikes<=1)
                {
                    alert("You cannot delete users with less than 1 strikes");
                    return;
                }
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                    xmlhttp.open("GET", "../user/deleteUsersByStrikes.php?strikes="+strikes, true);
                    xmlhttp.send();
                
            }
            
            function deleteTicket(id)
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert("Action Completed");
                            getTickets();
                        }
                    };
                    xmlhttp.open("GET", "../ticket/deleteTicket.php?ticket_id="+id, true);
                    xmlhttp.send();
            }
            
            function checkUserAdmin(id,action)
            {
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText>=1)
                            {
                                if(action===1)
                                {
                                    deleteComment(id);
                                }else if(action===2)
                                {
                                    deleteTicket(id);
                                }else if(action===3)
                                {
                                    deleteUsersByStrikes();
                                }else if(action===4)
                                {
                                    
                                }else if(action===5)
                                {
                                    makeUserAdmin(id);
                                }else if(action===6)
                                {
                                    deleteRecipe(id);
                                }else if(action===10)
                                {
                                    deleteUser(id);
                                }else if(action>=7)
                                {
                                    setUserStatus(action);
                                }
                            }else
                            {
                                alert("You do not have admin permission to perform this action!");
                            }
                        }
                    };
                    xmlhttp.open("GET", "../user/checkLoginAdminStatus.php?user_id="+user_id, true);
                    xmlhttp.send();
            }
            
            function getDatabaseStats()
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText == -1)
                            {
                                document.getElementById("dbOnline").innerHTML = "The database is unresponsive.";
                            }else
                            {
                                document.getElementById("dbOnline").innerHTML = "The database is currently online.";
                                document.getElementById("dbSize").innerHTML = "The database is currently occupying "+this.responseText+" mb of memory in the server.";
                            }
                        }
                    };
                    xmlhttp.open("GET", "../model/get_database_size.php", true);
                    xmlhttp.send();
            }
            
            function setWarning(ticket_id)
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            
                        }
                    };
                    xmlhttp.open("GET", "../ticket/set_warning.php?ticket_id="+ticket_id, true);
                    xmlhttp.send();
            }
        
        </script>
        
        <div>
            <p>Server info:</p>
            <p id="dbOnline"></p>
            <p id="dbSize"></p>
        </div>
        
        <div>
            Perform action on specific user:
            <input type="text" placeholder="Enter username here..." id="usernameInput">
            <button onclick="checkUserAdmin(0,7)">Make User Admin</button>
            <button onclick="checkUserAdmin(0,8)">Remove User Admin</button>
            <button onclick="checkUserAdmin(0,9)">Delete User</button>
        </div>
        <div>            
            Delete all users with more than x number of strikes
            <input type="number" id="strikes">
            <button onclick="checkUserAdmin(0,3)">Deleted</button>
        </div>
        Sort By:
        <select id="report_sort" onchange="getTickets()" class="ignore-class">
            <option value="date_submitted">Submitted Date</option>
            <option value="deadline">Deadline</option>
        </select>
       
        <select id="report_order" onchange="getTickets()" class="ignore-class">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
        <br>
        Content Type:
        <select id="content" onchange="getTickets()">
            <option value="all">All</option>
            <option value="user">User</option>
            <option value="recipe">Recipe</option>
            <option value="review">Review</option>
        </select>
        
        <br>
        Report Type:
        <select id="type" onchange="getTickets()">
            <option value="all">All</option>
            <option value="profanity">Profanity</option>
            <option value="impersonation">Impersonation</option>
            <option value="malicious links">Malicious Links</option>
            <option value="missing allergen">Missing Allergen</option>
            <option value="incorrect recipe">Incorrect recipe</option>
            <option value=""></option>
        </select>
        <br>
        <div>
        
       
        <div id="tickets"></div>
    </body>
</html>