<?php
$current = 'home';
include 'header.php';
?>

<button class="unimealMe" style="background-color: #007bff;">Unimeals Me!</button>
<div class="container">
    
     <div class="row">

        <!--        side div-->
        <div class="col-lg-2">
            

        <input type="text" id="term"><button onclick="searchRecipe()">Search</button><br>
        
        <button class="collapsible" onclick="collapsible()">Meat</button>
<div class="content">
    <input type="checkbox" name="Chicken" value="Chicken" class="tag">Chicken <br>
    <input type="checkbox" name="Pork" value="Pork" class="tag">Pork <br>
    <input type="checkbox" name="Beef" value="Beef" class="tag">Beef <br>
</div>
        <button class="collapsible" onclick="collapsible()">Sea Food</button>
<div class="content">
    <input type="checkbox" name="Cod" value="Cod" class="tag">Cod <br>
    <input type="checkbox" name="Salmon" value="Salmon" class="tag">Salmon <br>
    <input type="checkbox" name="Tuna" value="Tuna" class="tag">Tuna <br>
</div>

<button class="collapsible" onclick="collapsible()">vegetables </button>
<div class="content">
    
    <input type="checkbox" name="Carrots" value="Carrots" class="tag">Carrots<br>
    <input type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber<br>
    <input type="checkbox" name="Mushrooms" value="Mushrooms" class="tag">Mushrooms
</div>
<button class="collapsible" onclick="collapsible()">Fruit </button>
<div class="content">
    <input type="checkbox" name="Tomatoes" value="Tomatoes" class="tag">Tomatoes<br>
    <input type="checkbox" name="Apples" value="Apples" class="tag">Apples<br>
    <input type="checkbox" name="Strawberries" value="Strawberries" class="tag">Strawberries
</div>
<button class="collapsible" onclick="collapsible()">Serving</button>
<div class="content">
    <input type="number" name="serving" value="1" class="tag"/>
    
</div>
<button class="collapsible" onclick="collapsible()">Allergies</button>
<div class="content">
    <input type="checkbox" name="nut" value="no_nuts" class="noTag">Nuts <br>
    <input type="checkbox" name="lactose" value="no_lactose" class="noTag">Lactose <br>
    <input type="checkbox" name="gluton" value="no_gluton" class="noTag">Gluten <br>
    
    
</div>
<button class="collapsible" onclick="collapsible()">Lifestyle </button>
<div class="content">
    <input type="checkbox" name="vegan" value="vegan" class="tag">Vegan <br>
    <input type="checkbox" name="Vegetarian" value="Vegetarian" class="tag">Vegetarian <br>
    <input type="checkbox" name="Pescatarian" value="Pescatarian" class="tag">Pescatarian <br>
    <input type="checkbox" name="Budget" value="Budget" class="tag">Budget <br>
    <input type="checkbox" name="Onepot" value="Onepot" class="tag">Onepot <br>
</div>
<button class="collapsible" onclick="collapsible()">Cuisine </button>
<div class="content">
    <input type="checkbox" name="Mexican" value="Mexican" class="tag">Mexican <br>
    <input type="checkbox" name="Indian" value="Indian" class="tag">Indian <br>
    <input type="checkbox" name="Chinese" value="Chinese" class="tag">Chinese <br>
    <input type="checkbox" name="Italian" value="Italian" class="tag">Italian <br>
    
</div>
<button class="collapsible" onclick="collapsible()">Easy to make </button>
<div class="content">
    <input type="checkbox" name="Salad" value="Salad" class="tag">Salad <br>
    <input type="checkbox" name="Sandwiches" value="Sandwiches" class="tag">Sandwiches <br>
    
    
</div>
<button class="collapsible" onclick="collapsible()">Cooking method </button>
<div class="content">
    <input type="checkbox" name="Fried" value="Fried" class="tag">Fried <br>
    <input type="checkbox" name="Grilled" value="Grilled" class="tag">Grilled <br>
    <input type="checkbox" name="Oven" value="Oven" class="tag">Oven <br>
    <input type="checkbox" name="Baking" value="Baking" class="tag">Baking <br>
    
</div>
        
<!--        <p>Must have:</p>
        
        <input type="checkbox" value="halal" class="tag">Halal<br>
        <input type="checkbox" value="kosher" class="tag">Kosher<br>
       
        
        <p>Exclude:</p>
        <input type="checkbox" value="no_wheat" class="noTag">Wheat<br>
        <input type="checkbox" value="no_crustacean" class="noTag">Crustaceans<br>
        <input type="checkbox" value="no_egg" class="noTag">Egg<br>
        <input type="checkbox" value="no_fish" class="noTag">Fish<br>
        <input type="checkbox" value="no_peanut" class="noTag">Peanuts<br>
        <input type="checkbox" value="no_soy" class="noTag">Soy<br>
        <input type="checkbox" value="no_milk" class="noTag">Milk<br>
        <input type="checkbox" value="no_nuts" class="noTag">Nuts<br>
        <input type="checkbox" value="no_celery" class="noTag">Celery<br>
        <input type="checkbox" value="no_mustard" class="noTag">Mustard<br>
        <input type="checkbox" value="no_sesame" class="noTag">Sesame<br>
        <input type="checkbox" value="no_shellfish" class="noTag">Shellfish<br>-->
        
        Sort by 
        <select id="sort">
            <option value="name">Name</option>
            <option value="date">Submitted Date</option>
            <option value="rating">User Rating</option>
            <option value="time">Cooking Time</option>
 
        </select>
        <select id="order">
            <option value="asc">Ascending Order</option>
            <option value="desc">Descending Order</option>
        </select>
        
        
        
        
        
        
       
        </div>
        <!-- /.col-lg-3 -->
        
        <!--        body div-->

        <div class="col-lg-9">
        <div id="result"></div>

        </div>
        <!-- /.col-lg-9 -->
        
         <div class="col-lg-0">

    


        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
        
        
        
<?php
include 'footer.php';
?>
    </body>
</html>
