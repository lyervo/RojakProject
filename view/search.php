<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <script>
            function searchRecipe()
            {
                var term = document.getElementById("term").value;
                
                var sort = document.getElementById("sort").value;
                
                var order = document.getElementById("order").value;
                
                var tags = document.getElementsByClassName("tag");
                
                var noTags = document.getElementsByClassName("noTag");
                

                var noTagString = "";
                
                var tagString = "";
                
                var first = true;
                
                var checked = false;
                
                for(var i=0;i<tags.length;i++)
                {
                    if(tags[i].checked)
                    {
                        if(first)
                        {
                            tagString += tags[i].value;
                            first = false;
                        }else
                        {
                            tagString += "%%"+tags[i].value;
                        }
                        checked = true;
                    }
                }
                
                if(!checked)
                {
                    tagString = "null";
                }
                
                checked = false;
                
                first = true;
                
                
                for(var i=0;i<noTags.length;i++)
                {
                    if(noTags[i].checked)
                    {
                        if(first)
                        {
                            noTagString += noTags[i].value;
                            first = false;
                        }else
                        {
                            noTagString += "%%"+noTags[i].value;
                        }
                        checked = true;
                    }
                }
                
                if(!checked)
                {
                    noTagString = "null";
                }
                
                if (term.length == 0) 
                {
                    document.getElementById("result").innerHTML = "";
                   
                }else
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("result").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../recipe/search_recipe.php?term=" + term + "&sort=" + sort + "&order="+order +"&tag="+tagString+"&noTag="+noTagString, true);
                    xmlhttp.send();
                }
            }
            
        </script>
        <input type="text" id="term"><button onclick="searchRecipe()">Search</button><br>
        
        <p>Must have:</p>
        <input type="checkbox" value="vegan" class="tag" onchange="searchRecipe()">Vegan<br>
        <input type="checkbox" value="halal" class="tag" onchange="searchRecipe()">Halal<br>
        <input type="checkbox" value="kosher" class="tag" onchange="searchRecipe()">Kosher<br>
       
        
        <p>Exclude:</p>
        <input type="checkbox" value="no_wheat" class="noTag" onchange="searchRecipe()">Wheat<br>
        <input type="checkbox" value="no_crustacean" class="noTag" onchange="searchRecipe()">Crustaceans<br>
        <input type="checkbox" value="no_egg" class="noTag" onchange="searchRecipe()">Egg<br>
        <input type="checkbox" value="no_fish" class="noTag" onchange="searchRecipe()">Fish<br>
        <input type="checkbox" value="no_peanut" class="noTag" onchange="searchRecipe()">Peanuts<br>
        <input type="checkbox" value="no_soy" class="noTag" onchange="searchRecipe()">Soy<br>
        <input type="checkbox" value="no_milk" class="noTag" onchange="searchRecipe()">Milk<br>
        <input type="checkbox" value="no_nuts" class="noTag" onchange="searchRecipe()">Nuts<br>
        <input type="checkbox" value="no_celery" class="noTag" onchange="searchRecipe()">Celery<br>
        <input type="checkbox" value="no_mustard" class="noTag" onchange="searchRecipe()">Mustard<br>
        <input type="checkbox" value="no_sesame" class="noTag" onchange="searchRecipe()">Sesame<br>
        <input type="checkbox" value="no_shellfish" class="noTag" onchange="searchRecipe()">Shellfish<br>
        
        Sort by 
        <select id="sort" onchange="searchRecipe()">
            <option value="recipe_name">Name</option>
            <option value="time">Submitted Date</option>
            <option value="rating">User Rating</option>
            <option value="cooking_time">Cooking Time</option>
 
        </select>
        <select id="order" onchange="searchRecipe()">
            <option value="asc">Ascending Order</option>
            <option value="desc">Descending Order</option>
        </select>
        <div id="result"></div>
    </body>
</html>
