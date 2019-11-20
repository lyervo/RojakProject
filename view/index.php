<?php
$current = 'home';
include 'header.php';

?>
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
    }

    if (term.length == 0)
    {
        term = "null";

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



function collapsible(){
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

        <!--        side div-->
        <div class="col-lg-11">

            <input type="text" id="term" placeholder="Search..."><button id="search_icon" onclick="searchRecipe()"><i class="fas fa-search"></i></button><br>



<div class="container">
    
     <div class="row">

        <!--        side div-->
        <div class="col-lg-3">


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
    <div class="filterButton" id="chicken" onclick="checkTag('chicken')" >
        <input hidden id="filterButton" type="checkbox" name="chicken" value="chicken" class="tag">Chicken </div>
    
    <div class="filterButton" id="Pork" onclick="checkTag('Pork')" >
    <input hidden id="filterButton" type="checkbox" name="Pork" value="Pork" class="tag">Pork </div>
    
    <div class="filterButton" id="Beef" onclick="checkTag('Beef')">
    <input hidden id="filterButton" type="checkbox" name="Beef" value="Beef" class="tag">Beef </div>
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
      </div>
    </div>
  </div>
    
      <div class="card z-depth-0 bordered">
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
<div class="filterButton" id="Tomatoes" onclick="checkTag('Tomatoes')">
    <input hidden  type="checkbox" name="Tomatoes" value="Tomatoes" class="tag">Tomatoes </div>
    <div class="filterButton" id="Cucumber" onclick="checkTag('Cucumber')">
    <input hidden  type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber </div>
    <div class="filterButton" id="Strawberries" onclick="checkTag('Strawberries')">
    <input hidden  type="checkbox" name="Strawberries" value="Strawberries" class="tag">Strawberries</div>
      </div>
    </div>
  </div>
  <div class="card z-depth-0 bordered">
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
  </div>
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
      <div class="card-body">
<div class="filterButton" id="Nuts" onclick="checkTag('wheat')">
    <input hidden type="checkbox" name="Nuts" value="wheat" class="noTag">Wheat </div>
    <div class="filterButton" id="Lactose" onclick="checkTag('Lactose')">
    <input hidden type="checkbox" name="Lactose" value="Lactose" class="noTag">Lactose </div>
    <div class="filterButton" id="Gluten" onclick="checkTag('Gluten')">
    <input hidden  type="checkbox" name="Gluten" value="Gluten" class="noTag">Gluten </div>
      </div>
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
      </div>
    </div>
  </div>
  <div class="card z-depth-0 bordered">
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
  </div>
    
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

            
        </div>
     </div>
         
</div>


            Sort by 
            <select id="sort">
                <option value="recipe_name">Name</option>
                <option value="time">Submitted Date</option>
                <option value="rating">User Rating</option>
                <option value="cooking_time">Cooking Time</option>

            </select>
            <select id="order">
                <option value="asc">Ascending Order</option>
                <option value="desc">Descending Order</option>
            </select>

            
             <!-- Button trigger modal -->
             
             
        
        
        

        
        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->

       
        <div class="col-lg-0">

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
