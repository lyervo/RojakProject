<?php
include "../model/db_connect.php";
include 'header.php';
require '../login_session/session.php';
?>

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
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText >= 1)
                {
                    user_id = this.responseText;

                    getTickets();
                    getDatabaseStats();
                } else
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
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("tickets").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../ticket/getTickets.php?order=" + sort + "&asc=" + order + "&content=" + content + "&type=" + type, true);
        xmlhttp.send();

    }

    function setUserStatus(action)
    {

        var username = document.getElementById("usernameInput").value;


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "../user/setUserStatus.php?username=" + username + "&action=" + action, true);
        xmlhttp.send();

    }

    function deleteComment(id)
    {

        alert("wdfghj");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
                getTickets();
            }
        };
        xmlhttp.open("GET", "../ticket/deleteReview.php?recipe_id=0&review_id=" + id, true);
        xmlhttp.send();

    }

    function deleteRecipe(id)
    {


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
                getTickets();
            }
        };
        xmlhttp.open("GET", "../ticket/deleteReview.php?review_id=0&recipe_id=" + id, true);
        xmlhttp.send();

    }

    function deleteUser(id)
    {


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert("Action Completed");
                getTickets();
            }
        };
        xmlhttp.open("GET", "../ticket/deleteUser.php?user_id=" + id, true);
        xmlhttp.send();

    }

    function deleteUsersByStrikes()
    {
        var strikes = document.getElementById("strikes").value;
        if (strikes <= 1)
        {
            alert("You cannot delete users with less than 1 strikes");
            return;
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("GET", "../user/deleteUsersByStrikes.php?strikes=" + strikes, true);
        xmlhttp.send();

    }

    function deleteTicket(id)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert("Action Completed");
                getTickets();
            }
        };
        xmlhttp.open("GET", "../ticket/deleteTicket.php?ticket_id=" + id, true);
        xmlhttp.send();
    }

    function checkUserAdmin(id, action)
    {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText >= 1)
                {
                    if (action === 1)
                    {
                        deleteComment(id);
                    } else if (action === 2)
                    {
                        deleteTicket(id);
                    } else if (action === 3)
                    {
                        deleteUsersByStrikes();
                    } else if (action === 4)
                    {

                    } else if (action === 5)
                    {
                        makeUserAdmin(id);
                    } else if (action === 6)
                    {
                        deleteRecipe(id);
                    } else if (action === 10)
                    {
                        deleteUser(id);
                    } else if (action >= 7)
                    {
                        setUserStatus(action);
                    }
                } else
                {
                    alert("You do not have admin permission to perform this action!");
                }
            }
        };
        xmlhttp.open("GET", "../user/checkLoginAdminStatus.php?user_id=" + user_id, true);
        xmlhttp.send();
    }

    function getDatabaseStats()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if (this.responseText == -1)
                {
                    document.getElementById("dbOnline").innerHTML = "The database is unresponsive.";
                } else
                {
                    document.getElementById("dbOnline").innerHTML = "The database is currently online.";
                    document.getElementById("dbSize").innerHTML = "The database is currently occupying " + this.responseText + " mb of memory in the server.";
                }
            }
        };
        xmlhttp.open("GET", "../model/get_database_size.php", true);
        xmlhttp.send();
    }

    function setWarning(ticket_id)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {

            }
        };
        xmlhttp.open("GET", "../ticket/set_warning.php?ticket_id=" + ticket_id, true);
        xmlhttp.send();
    }

</script>

<div class="container">

    <div class="row">
        <div class="col-lg-9">
            <div>

                <p>Server info:</p>
                <p id="dbOnline"></p>
                <p id="dbSize"></p>
            </div>

            <div>
                Perform action on specific user:
                <input type="text" placeholder="Enter username here..." id="usernameInput">
                <br>
                <div id="userNameButtons">
                    <button class="btn btn-primary" onclick="checkUserAdmin(0, 7)">Make User Admin</button>
                    <button class="btn btn-primary" onclick="checkUserAdmin(0, 8)">Remove User Admin</button>
                    <button class="btn btn-primary" onclick="checkUserAdmin(0, 9)">Delete User</button>
                </div>
            </div>
            <div>
                <br>            
                Delete all users with more than x number of strikes
                <input type="number" id="strikes">
                <br>
                <button class="btn btn-primary" onclick="checkUserAdmin(0, 3)">Delete</button>

            </div>
            <br>



            Sort By:
            <select id="report_sort" onchange="getTickets()" class="ignore-class">
                <option value="date_submitted">Submitted Date</option>
                <option value="deadline">Deadline</option>
            </select>
            <br><br>
            Order By:
            <select id="report_order" onchange="getTickets()" class="ignore-class">
                <option value="asc">Ascending Order</option>
                <option value="desc">Descending Order</option>
            </select>

            <br><br>
            Content Type:
            <select class="reportContentType" id="content" onchange="getTickets()">
                <option value="all">All</option>
                <option value="user">User</option>
                <option value="recipe">Recipe</option>
                <option value="review">Review</option>
            </select>

            <br><br>
            Report Type:
            <select class="reportType" id="type" onchange="getTickets()">
                <option value="all">All</option>
                <option value="profanity">Profanity</option>
                <option value="impersonation">Impersonation</option>
                <option value="malicious links">Malicious Links</option>
                <option value="missing allergen">Missing Allergen</option>
                <option value="incorrect recipe">Incorrect recipe</option>

            </select>
            <br><br>


        </div>
        <div id="tickets"></div>
    </div>
</div>

<?php
include 'footer.php';
?>
</body>
</html>