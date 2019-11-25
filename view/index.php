<?php
$current = 'home';
include 'header.php';
require '../recipe/recipe_db.php';
$user = showuser();
?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--        side div-->
        <div class="col-lg-3">

            <input type="text" id="term" placeholder="Search..."><button id="search_icon" onclick="searchRecipe()"><i class="fas fa-search"></i></button>

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

                            <div class="filterButton" id="Pork" onclick="checkTag('Pork')" >
                                <input hidden id="filterButton" type="checkbox" name="Pork" value="Pork" class="tag">Pork </div>

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

                            <div class="filterButton" id="Peas" onclick="checkTag('Peas')">
                                <input hidden type="checkbox" name="Peas" value="Peas" class="tag">Peas </div>
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
                        <div class="card-body">
                            <div class="filterButton" id="Nuts" onclick="checkTag('wheat')">
                                <input hidden type="checkbox" name="Nuts" value="wheat" class="noTag">Wheat </div>

                            <div class="filterButton" id="Lactose" onclick="checkTag('Lactose')">
                                <input hidden type="checkbox" name="Lactose" value="Lactose" class="noTag">Lactose </div>

                            <div class="filterButton" id="Gluten" onclick="checkTag('Gluten')">
                                <input hidden  type="checkbox" name="Gluten" value="Gluten" class="noTag">Gluten </div>

                            <div class="filterButton" id="Nuts" onclick="checkTag('Nuts')">
                                <input hidden type="checkbox" name="Nuts" value="Nuts" class="noTag">Nuts </div>

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







        </div>
        <!-- /.col-lg-3 -->

        <!--        body div-->
        <div class="col-lg-9"id="result">

            <div class="sorting">
                <p id="sort_title">Sort by<p> 
                    <select id="sort">
                        <option value="recipe_name">Name</option>
                        <option value="time">Submitted Date</option>
                        <option value="rating">User Rating</option>
                        <option value="cooking_time">Cooking Time</option>

                    </select>
                <p id="sort_title2">Order By</p>
                <select id="order">
                    <option value="asc">Ascending Order</option>
                    <option value="desc">Descending Order</option>
                </select>
            </div>

            <?php
            $response = '';

            foreach ($user as $v) {
                ?>

                <div class="div1">


                    <div class="recipecard">


                        <?php echo '<a href="?action=view_recipe&id=' . $v['recipe_id'] . '"><img src="data:image/jpeg;base64,' . base64_encode($v['image_blob']) . '" height="160px" width="250px"/></a>'; ?>
                        <div class="name"> <h2 id="recipe_title"><?php echo "<a style='text-decoration: none; color: black;' href='?action=view_recipe&id=" . $v['recipe_id'] . "'> " . $v['recipe_name'] . "</a>" ?></h2></div>
                        <div class="prod_details_tab">
                            <?php
                            $dif = $v['difficulty'];
                            $easy = 'Easy';
                            $medium = 'Medium';
                            $hard = 'Hard';

                            if ($v['difficulty'] == $easy) {
                                ?>
                                <a>

                                    <i id="iconEasy" class="fas fa-utensils">
                                        <div id="diff"><p id="diff_title">Easy</p></div>
                                    </i>
                                </a>     
                                <?php
                            }
                            if ($v['difficulty'] == $hard) {
                                ?>

                                <a>
                                    <i id="icon1Hard" class="fas fa-utensils"></i></a> 
                                <a>
                                    <i id="icon2Hard" class="fas fa-utensils"></i></a> 
                                <a>
                                    <i id="icon3Hard" class="fas fa-utensils"></i></a>
                                <?php
                            }
                            if ($v['difficulty'] == $medium) {
                                ?>
                                <a>
                                    <i id="icon1Med" class="fas fa-utensils"></i></a> 
                                <a>
                                    <i id="icon2Med" class="fas fa-utensils"></i></a> 
                            <?php } ?>

                        </div>
                        <br>
                        <p class="info"></a>By <?php echo "<a href='?action=user_profile&user_id=" . $v['user_id'] . "'>" . $v['username'] . "</a>" ?></p>
                        <p class="info"></a>Cooking Time: <?php echo $v['cooking_time'] ?> min</p>

                        <div class="fadeingdescriptions">
                            <p><?php echo $v['description'] ?></p>
                        </div>

                        <p><?php echo "<button id='button_view'><a id='view_button' href='?action=view_recipe&id=" . $v['recipe_id'] . "'>View</a></button>" ?></p>

                    </div>


                </div>
                <?php
            }
            ?>  





        </div>

        <div class="col-lg-1">

            <div class="icons">

                <table>
                    <tr>
                        <th>
                            diff
                        </th>
                        <th>
                            forks
                        </th>
                    </tr>
                    <tr>
                        <td>
                            easygoing
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

<!--<script>
window.onscroll = function() {myFunction()};

var sort = document.getElementById("sortNav");
var sticky = sort.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    sort.classList.add("sticky");
  } else {
    sort.classList.remove("sticky");
  }
}

</script>-->

<?php
include 'footer.php';
?>

</body>

</html>
