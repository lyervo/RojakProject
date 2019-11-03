<?php

    include "model/db_connect.php";

?>
<html>
    <head>
        <title></title>
    </head>
    <body onload="getTickets()">
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
        <script>
          
            function getTickets()
            {
 

                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("tickets").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "ticket/getTickets.php?order=ticket_id", true);
                    xmlhttp.send();
            
            }
            
            function deleteComment(id)
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
                    xmlhttp.open("GET", "ticket/deleteReview.php?review_id="+id, true);
                    xmlhttp.send();
            
            }
            
            function deleteRecipe(id)
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
                    xmlhttp.open("GET", "ticket/deleteRecipe.php?recipe_id="+id, true);
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
                    xmlhttp.open("GET", "user/deleteUsersByStrikes.php?strikes="+strikes, true);
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
                    xmlhttp.open("GET", "ticket/deleteTicket.php?ticket_id="+id, true);
                    xmlhttp.send();
            }
            
            function checkUserAdmin(id,action)
            {
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            if(this.responseText==1)
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
                                    alert("run");
                                    deleteRecipe(id);
                                }
                            }else
                            {
                                alert("You do not have admin permission to perform this action!");
                            }
                        }
                    };
                    xmlhttp.open("GET", "user/checkUserAdmin.php?user_id=<?php echo $_SESSION['user_id'] ?>", true);
                    xmlhttp.send();
            }
            
            function makeUserAdmin(id)
            {
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            
                        }
                    };
                    xmlhttp.open("GET", "user/makeUserAdmin.php?user_id="+id, true);
                    xmlhttp.send();
            }
        
        </script>
        <div>            
            Delete all users with more than x number of strikes
            <input type="number" id="strikes">
            <button onclick="checkUserAdmin(0,3)">Deleted</button>
        </div>
        
        <div id="tickets"></div>
    </body>
</html>