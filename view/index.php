<?php
$current = 'home';
include 'header.php';
require '../recipe/recipe_db.php';
$user = showuser();
?>

<script>
    
    var allergies = ["Gluten","Lactose","Nuts","Fish","Egg","Peanuts","Celery","Shellfish","Crustacean","Sesame"];
    
    var user_id;
    
    function init()
    {
        checkLoginStatus();
        
        
        var allergy_card_body = document.createElement("div");
        allergy_card_body.className = "card-body";
        
        for(var i=0;i<allergies.length;i++)
        {
            allergy_card_body.appendChild(createAllergyDivGroup(allergies[i]));
        }
        var listDiv = document.getElementById("collapseSix2");
        listDiv.appendChild(allergy_card_body)
        document.getElementById("term").addEventListener("keydown",
            function(event)
            {
                if(event.keyCode==13)
                {

                    searchRecipe();
                }
            });
        changeColourOnHover();
        
    }
    
    
    
    function createAllergyDivGroup(allergy)
    {
        var div = document.createElement("div");
        div.className = "filterButton";
        div.id = allergy+" Allergy";
        div.innerHTML = allergy;
        div.addEventListener("click",function()
        {
            checkTag(allergy+" Allergy");
            
        });
        var checkbox = document.createElement("input");
        checkbox.setAttribute("type","checkbox");
        checkbox.name = allergy+" Allergy";
        checkbox.value = allergy+" Allergy";
        checkbox.className = "noTag";
        checkbox.style.display = "none";
        
        div.appendChild(checkbox);
        return div;
        
        
    }

function getAllRecipe()
{
    var sort = document.getElementById("sort").value;

    var order = document.getElementById("order").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../recipe/getAllRecipe.php", true);
        xmlhttp.send();
}

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

    var searchByTag = false;

    for (var i = 0; i < tags.length; i++)
    {
        if (tags[i].checked)
        {
            if (first)
            {
                tagString += tags[i].value;
                first = false;
            } else
            {
                tagString += "%%" + tags[i].value;
            }
            checked = true;
        }
    }

    if (!checked)
    {
        tagString = "null";
        
    }else
    {
        searchByTag = true;
    }

    checked = false;

    first = true;


    for (var i = 0; i < noTags.length; i++)
    {
        if (noTags[i].checked)
        {
            if (first)
            {
                noTagString += noTags[i].value;
                first = false;
            } else
            {
                noTagString += "%%" + noTags[i].value;
            }
            checked = true;
        }
    }

    if (!checked)
    {
        noTagString = "null";
    }else
    {
        searchByTag = true;
    }

    if (term.length == 0&&searchByTag)
    {
        term = "null";

    } else if(term.length == 0)
    {
        getRecommend();
        return;
    }
    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../recipe/search_recipe.php?term=" + term + "&sort=" + sort + "&order=" + order + "&tag=" + tagString + "&noTag=" + noTagString, true);
        xmlhttp.send();
    
}

    function getRecommend()
    {
        if(user_id == null)
        {
            user_id = 0;
        }

        var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {

                    document.getElementById("result").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "../recipe/recommendRecipe.php?user_id="+user_id, true);
            xmlhttp.send();
    }

    function checkLoginStatus()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                user_id = this.responseText;
                getRecommend();
            }
        };
        xmlhttp.open("GET", "../user/checkLoginStatus.php", true);
        xmlhttp.send();
    }

    function collapsible()
    {
        var coll = document.getElementsByClassName("collapsible");



        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
              content.style.maxHeight = null;
            } else {
              content.style.maxHeight = content.scrollHeight + "px";
            } 
          });
        }
    }
            
            
    function checkTag(tagName)
    {

        let tags = document.getElementsByClassName('tag');
        let noTags = document.getElementsByClassName('noTag');
    //    let arr2 = document.getElementsByClassName("btn btn-link");

        for(let i = 0; i < tags.length; i++)
        {
            if(tags[i].value == tagName)
            {

                tags[i].checked = !tags[i].checked;
                if(tags[i].checked)
                {
                    tags[i].parentElement.style.backgroundColor = "#005aba";
                    tags[i].parentElement.style.color = "white";
                    tags[i].parentElement.style.border = "1px solid #005aba";
                }else
                {

                    tags[i].parentElement.style.backgroundColor = "white";
                    tags[i].parentElement.style.color = "black";
                    tags[i].parentElement.style.border = "1px solid #007bff";



                }
            }

        }

            for(let i = 0; i < noTags.length; i++)
            {
                if(noTags[i].value == tagName)
                {
                    noTags[i].checked = !noTags[i].checked;
                      if(noTags[i].checked)
                {
                    noTags[i].parentElement.style.backgroundColor = "#005aba";
                    noTags[i].parentElement.style.color = "white";
                    noTags[i].parentElement.style.border = "1px solid #005aba";
                }else
                {

                    noTags[i].parentElement.style.backgroundColor = "white";
                    noTags[i].parentElement.style.color = "black";
                    noTags[i].parentElement.style.border = "1px solid #007bff";



                }
                }

            }
    //    for(let i = 0; i < arr2.length; i++)
    //    {
    //        if(arr2[i].value == tagName)
    //        {
    //            arr2[i].checked = !arr2[i].checked;
    //            if(arr2[i].checked)
    //            {
    //                arr2[i].parentElement.style.backgroundColor = "#005aba";
    //
    //            }else
    //            {
    //                
    //                arr2[i].parentElement.style.backgroundColor = "#007bff";
    //
    //                
    //                
    //                
    //            }
    //        }
    //
    //    }

        searchRecipe();



    }

function hoverIn(x)
{
    if(x.children[0].checked)
    {
        
    }else
    {
        x.style.backgroundColor = "#007bff";
    }
}
function hoverOut(x)
{
    if(x.children[0].checked)
    {
        
    }else
    {
        x.style.backgroundColor = "#ffffff";
    }
}

//function hoverInHead(x)
//{
//    if(x.children[0].checked)
//    {
//        
//    }else
//    {
//        x.style.backgroundColor = "#005aba";
//    }
//}
//function hoverOutHead(x)
//{
//    if(x.children[0].checked)
//    {
//        
//    }else
//    {
//        x.style.backgroundColor = "#007bff";
//    }
//}

function changeColourOnHover()
{
    let arr = document.getElementsByClassName("filterButton");
//    let arr2 = document.getElementsByClassName("card-header");
    for(let i = 0; i < arr.length; i++)
    {
        arr[i].addEventListener("mouseover", function()
        {
           hoverIn(arr[i]); 
        },false);
        
        arr[i].addEventListener("mouseout", function()
        {
           hoverOut(arr[i]); 
        },false);
        
    }
    
//    for(let i = 0; i < arr2.length; i++)
//    {
//        arr2[i].addEventListener("mouseover", function()
//        {
//           hoverInHead(arr2[i]); 
//        },false);
//        
//        arr2[i].addEventListener("mouseout", function()
//        {
//           hoverOutHead(arr2[i]); 
//        },false);
//        
//    }
//    
}


function changeColourOnHoverButton()
{
    let arr = document.getElementById("headingOne2");
    for(let i = 0; i < arr.length; i++)
    {
        arr[i].addEventListener("mouseover", function()
        {
           hoverIn(arr[i]); 
        },false);
        
        arr[i].addEventListener("mouseout", function()
        {
           hoverOut(arr[i]); 
        },false);
        
    }
    
}




    
    
    </script>

<!-- Page Content -->
<div class="container">

    <div class="row">
        
        <div class="sorting">
            <p id="sort_title3"> <input  type="text" id="term" placeholder="Search..."><button id="search_icon" onclick="searchRecipe()"><i class="fas fa-search"></i></button></p>
                <p id="sort_title">Sort by<p> 
                    <select id="sort" onchange="searchRecipe()">
                        <option value="recipe_name">Name</option>
                        <option value="time">Submitted Date</option>
                        <option value="rating">User Rating</option>
                        <option value="cooking_time">Cooking Time</option>

                    </select>
                <p id="sort_title2">Order By</p>
                <select id="order" onchange="searchRecipe()">
                    <option value="asc">Ascending Order</option>
                    <option value="desc">Descending Order</option>
                </select>
            </div>

        <!--        side div-->
        <div class="col-lg-3">

            

            <br><br>


            <a id="top_button"></a>


            <div class="accordion" id="accordionExample275">

                <div class="card z-depth-0 bordered" >
                    <div class="card-header" id="headingOne2"  data-toggle="collapse" data-target="#collapseOne2"
                         aria-expanded="true" aria-controls="collapseOne2" > Meat
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" >

                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Chicken" onclick="checkTag('Chicken')" >
                                <input hidden id="filterButton" type="checkbox" name="Chicken" value="Chicken" class="tag">Chicken </div>

                            <div class="filterButton" id="pork" onclick="checkTag('pork')" >
                                <input hidden id="filterButton" type="checkbox" name="pork" value="pork" class="tag">Pork </div>

                            <div class="filterButton" id="Beef" onclick="checkTag('Beef')">
                                <input hidden id="filterButton" type="checkbox" name="Beef" value="Beef" class="tag">Beef </div>

                            <div class="filterButton" id="Turkey" onclick="checkTag('Turkey')">
                                <input hidden id="filterButton" type="checkbox" name="Turkey" value="Turkey" class="tag">Turkey </div>

                            <div class="filterButton" id="Lamb" onclick="checkTag('Lamb')">
                                <input hidden id="filterButton" type="checkbox" name="Lamb" value="Lamb" class="tag">Lamb </div>
                        </div>
                    </div>
                </div>
                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingTwo2"  data-toggle="collapse"
                         data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">Fish
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button">

                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Cod" onclick="checkTag('Cod')">
                                <input hidden id="filterButton" type="checkbox" name="Cod" value="Cod" class="tag">Cod </div>

                            <div class="filterButton" id="Salmon" onclick="checkTag('Salmon')">
                                <input hidden id="filterButton" type="checkbox" name="Salmon" value="Salmon" class="tag">Salmon </div>

                            <div class="filterButton" id="Tuna" onclick="checkTag('Tuna')">
                                <input hidden id="filterButton" type="checkbox" name="Tuna" value="Tuna" class="tag">Tuna </div>

                            <div class="filterButton" id="Trout" onclick="checkTag('Trout')">
                                <input hidden id="filterButton" type="checkbox" name="Trout" value="Trout" class="tag">Trout </div>

                            <div class="filterButton" id="Halibut" onclick="checkTag('Halibut')">
                                <input hidden id="filterButton" type="checkbox" name="Halibut" value="Halibut" class="tag">Halibut </div>
                        </div>
                    </div>
                </div>
                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingThree2" data-toggle="collapse"
                         data-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">Vegetables
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" >

                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree2" class="collapse" aria-labelledby="headingThree2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Carrots" onclick="checkTag('Carrots')">
                                <input hidden  type="checkbox" name="Carrots" value="Carrots" class="tag">Carrots </div>

                            <div class="filterButton" id="Cucumber" onclick="checkTag('Cucumber')">
                                <input hidden type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber </div>

                            <div class="filterButton" id="Mushrooms" onclick="checkTag('Mushrooms')">
                                <input hidden type="checkbox" name="Mushrooms" value="Mushrooms" class="tag">Mushrooms </div>

                            <div class="filterButton" id="Tomatoes" onclick="checkTag('Tomatoes')">
                                <input hidden type="checkbox" name="Tomatoes" value="Tomatoes" class="tag">Tomatoes </div>

                            <div class="filterButton" id="avocado" onclick="checkTag('avocado')">
                                <input hidden type="checkbox" name="avocado" value="avocado" class="tag">Avocado </div>
                        </div>
                    </div>
                </div>

                <!--                <div class="card z-depth-0 bordered">
                                    <div class="card-header" id="headingFour2" data-toggle="collapse" data-target="#collapseFour2"
                                         aria-expanded="true" aria-controls="collapseFour2">Fruit
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" >
                
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFour2" class="collapse" aria-labelledby="headingFour2"
                                         data-parent="#accordionExample275">
                                        <div class="card-body">
                                            <div class="filterButton" id="Apple" onclick="checkTag('Apple')">
                                                <input hidden  type="checkbox" name="Apple" value="Apple" class="tag">Apple </div>
                
                                            <div class="filterButton" id="Cucumber" onclick="checkTag('Cucumber')">
                                                <input hidden  type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber </div>
                
                                            <div class="filterButton" id="Strawberries" onclick="checkTag('Strawberries')">
                                                <input hidden  type="checkbox" name="Strawberries" value="Strawberries" class="tag">Strawberries</div>
                
                                            <div class="filterButton" id="Oranges" onclick="checkTag('Oranges')">
                                                <input hidden type="checkbox" name="Oranges" value="Oranges" class="tag">Oranges </div>
                
                                            <div class="filterButton" id="Grapes" onclick="checkTag('Grapes')">
                                                <input hidden type="checkbox" name="Grapes" value="Grapes" class="tag">Grapes </div>
                                        </div>
                                    </div>
                                </div>-->
                <!--  <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingFive2"  data-toggle="collapse"
                          data-target="#collapseFive2" aria-expanded="false" aria-controls="collapseFive2">Servings
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button">
                          
                        </button>
                      </h5>
                    </div>
                    <div id="collapseFive2" class="collapse" aria-labelledby="headingFive2"
                      data-parent="#accordionExample275">
                      <div class="card-body">
                    <input type="number" name="serving" value="1" class="tag"/>
                      </div>
                    </div>
                  </div>-->
                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingSix2" data-toggle="collapse"
                         data-target="#collapseSix2" aria-expanded="false" aria-controls="collapseSix2">Allergies
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" >

                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix2" class="collapse" aria-labelledby="headingSix2"
                         data-parent="#accordionExample275">
                        
                    </div>
                </div>

                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingSeven2" data-toggle="collapse" data-target="#collapseSeven2"
                         aria-expanded="true" aria-controls="collapseSeven2">Lifestyle
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" >

                            </button>
                        </h5>
                    </div>
                    <div id="collapseSeven2" class="collapse" aria-labelledby="headingSeven2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Vegan" onclick="checkTag('Vegan')">
                                <input hidden  type="checkbox" name="Vegan" value="Vegan" class="tag">Vegan </div>

                            <div class="filterButton" id="Vegetarian" onclick="checkTag('Vegetarian')">
                                <input hidden  type="checkbox" name="Vegetarian" value="Vegetarian" class="tag">Vegetarian </div>

                            <div class="filterButton" id="Pescaterian" onclick="checkTag('Pescaterian')">
                                <input hidden  type="checkbox" name="Pescaterian" value="Pescaterian" class="tag">Pescaterian </div>


                        </div>
                    </div>
                </div>
                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingEight2"  data-toggle="collapse"
                         data-target="#collapseEight2" aria-expanded="false" aria-controls="collapseEight2">Cuisine
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button">

                            </button>
                        </h5>
                    </div>
                    <div id="collapseEight2" class="collapse" aria-labelledby="headingEight2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Mexican" onclick="checkTag('Mexican')">
                                <input hidden  type="checkbox" name="Mexican" value="Mexican" class="tag">Mexican </div>

                            <div class="filterButton" id="Indian" onclick="checkTag('Indian')">
                                <input hidden  type="checkbox" name="Indian" value="Indian" class="tag">Indian </div>

                            <div class="filterButton" id="Chinese" onclick="checkTag('Chinese')">
                                <input hidden  type="checkbox" name="Chinese" value="Chinese" class="tag">Chinese </div>

                            <div class="filterButton" id="Italian" onclick="checkTag('Italian')">
                                <input hidden  type="checkbox" name="Italian" value="Italian" class="tag">Italian </div>

                            <div class="filterButton" id="Spanish" onclick="checkTag('Spanish')">
                                <input hidden type="checkbox" name="Spanish" value="Spanish" class="tag">Spanish </div>
                        </div>
                    </div>
                </div>
                <!--  <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingNine2" data-toggle="collapse"
                          data-target="#collapseNine2" aria-expanded="false" aria-controls="collapseNine2">Easy To Make
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" >
                          
                        </button>
                      </h5>
                    </div>
                    <div id="collapseNine2" class="collapse" aria-labelledby="headingNine2"
                      data-parent="#accordionExample275">
                      <div class="card-body">
                <div class="filterButton" id="Salad" onclick="checkTag('Salad')">
                    <input hidden  type="checkbox" name="Salad" value="Salad" class="tag">Salad </div>
                    <div class="filterButton" id="Sandwiches" onclick="checkTag('Sandwiches')">
                    <input hidden  type="checkbox" name="Sandwiches" value="Sandwiches" class="tag">Sandwiches </div>
                      </div>
                    </div>
                  </div>-->

                <div class="card z-depth-0 bordered">
                    <div class="card-header" id="headingTen2" data-toggle="collapse"
                         data-target="#collapseTen2" aria-expanded="false" aria-controls="collapseTen2">Cooking Method
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" >

                            </button>
                        </h5>
                    </div>
                    <div id="collapseTen2" class="collapse" aria-labelledby="headingTen2"
                         data-parent="#accordionExample275">
                        <div class="card-body">
                            <div class="filterButton" id="Chicken" onclick="checkTag('Fried')">
                                <input hidden  type="checkbox" name="Fried" value="Fried" class="tag">Fried </div>
                            <div class="filterButton" id="Grilled" onclick="checkTag('Grilled')">
                                <input hidden type="checkbox" name="Grilled" value="Grilled" class="tag">Grilled </div>
                            <div class="filterButton" id="Oven" onclick="checkTag('Oven')">
                                <input hidden  type="checkbox" name="Oven" value="Oven" class="tag">Oven </div>
                            <div class="filterButton" id="Budget" onclick="checkTag('Budget')">
                                <input hidden  type="checkbox" name="Budget" value="Budget" class="tag">Budget </div>
                            <div class="filterButton" id="Onepot" onclick="checkTag('Onepot')">
                                <input hidden  type="checkbox" name="Onepot" value="Onepot" class="tag">Onepot </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            
            <div id="icons">

                <table>
                    <tr>
                        <th>
                            difficulty
                        </th>
                        <th>
                            forks
                        </th>
                    </tr>
                    <tr>
                        <td>
                            easy
                        </td>
                        <td>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Medium
                        </td>
                        <td>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hard
                        </td>
                        <td>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                            <i id="iconEasy"class="fas fa-utensils"></i>
                        </td>
                    </tr>






                </table>
            </div>







        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-9"id="result">

            

           





        </div>

        

            

        


        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<br><br><br><br><br><br><br><br><br><br>

<script>
    var btn = $('#top_button');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });
</script>

<script>
window.onscroll = function() {myFunction()};

var sort = document.getElementById("icons");
var sticky = sort.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    sort.classList.add("sticky");
  } else {
    sort.classList.remove("sticky");
  }
}

</script>

<?php
include 'footer.php';
?>

</body>

</html>
