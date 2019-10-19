<?php
    
    include "../model/db_connect.php";
    require "../user/user_db.php";

    $id = $_REQUEST['user_id'];
    
    $user = getUserByID($id);
    
?>


    <head>
        <title><?php echo $user['username']; ?></title>
    </head>
    <body onload="init()">
        <script>
            
            function init()
            {
                getLikedRecipes();
            }
            
            function getLikedRecipes()
            {
                
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("favoriteRecipes").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../user/likedRecipe.php?user_id="+1, true);
                    xmlhttp.send();
                
            }
            
            
            
        </script>
        
        
        
        <h1><?php echo $user['username']; ?></h1>
        
        
        <h2>Liked Recipes</h2>
        <div id="favoriteRecipes">
            
        </div>
        
        
    </body>
