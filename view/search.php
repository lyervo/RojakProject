<?php
$current = 'home';
include 'header.php';
?>

<button class="unimealMe" style="background-color: #007bff;">Unimeals Me!</button>
<div class="container">
    
     <div class="row">

        <!--        side div-->
        <div class="col-lg-11">
            

        <input type="text" id="term"><button onclick="searchRecipe()">Search</button>
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
        <br><br>
        <button class="collapsible" onclick="collapsible()">Meat</button>
        
<div class="content">
   
    <div class="filterButton" id="Chicken" onclick="checkTag('Chicken')" >
        <input hidden id="filterButton" type="checkbox" name="Chicken" value="Chicken" class="tag">Chicken </div>
    
    <div class="filterButton" id="Pork" onclick="checkTag('Pork')" >
    <input hidden id="filterButton" type="checkbox" name="Pork" value="Pork" class="tag">Pork </div>
    
    <div class="filterButton" id="Beef" onclick="checkTag('Beef')">
    <input hidden id="filterButton" type="checkbox" name="Beef" value="Beef" class="tag">Beef </div>
    
</div>
        
        <button class="collapsible" onclick="collapsible()">Sea Food</button>
<div class="content">
   
<div class="filterButton" id="Cod" onclick="checkTag('Cod')">
    <input hidden id="filterButton" type="checkbox" name="Cod" value="Cod" class="tag">Cod </div>
<div class="filterButton" id="Salmon" onclick="checkTag('Salmon')">
    <input hidden id="filterButton" type="checkbox" name="Salmon" value="Salmon" class="tag">Salmon </div>
<div class="filterButton" id="Tuna" onclick="checkTag('Tuna')">
    <input hidden id="filterButton" type="checkbox" name="Tuna" value="Tuna" class="tag">Tuna </div>
    
</div>

<button class="collapsible" onclick="collapsible()">vegetables </button>
<div class="content">
   
<div class="filterButton" id="Carrots" onclick="checkTag('Carrots')">
    <input hidden  type="checkbox" name="Carrots" value="Carrots" class="tag">Carrots </div>
    <div class="filterButton" id="Cucumber" onclick="checkTag('Cucumber')">
    <input hidden type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber </div>
    <div class="filterButton" id="Mushrooms" onclick="checkTag('Mushrooms')">
    <input hidden type="checkbox" name="Mushrooms" value="Mushrooms" class="tag">Mushrooms </div>
    
</div>

<button class="collapsible" onclick="collapsible()">Fruit </button>
<div class="content">
   
<div class="filterButton" id="Tomatoes" onclick="checkTag('Tomatoes')">
    <input hidden  type="checkbox" name="Tomatoes" value="Tomatoes" class="tag">Tomatoes </div>
    <div class="filterButton" id="Cucumber" onclick="checkTag('Cucumber')">
    <input hidden  type="checkbox" name="Cucumber" value="Cucumber" class="tag">Cucumber </div>
    <div class="filterButton" id="Strawberries" onclick="checkTag('Strawberries')">
    <input hidden  type="checkbox" name="Strawberries" value="Strawberries" class="tag">Strawberries</div>
    
</div>

<button class="collapsible" onclick="collapsible()">Serving</button>
<div class="content">
    
    <input type="number" name="serving" value="1" class="tag"/>
    
</div>


<button class="collapsible" onclick="collapsible()">Allergies</button>
<div class="content">
    
<div class="filterButton" id="Nuts" onclick="checkTag('Nuts')">
    <input hidden type="checkbox" name="Nuts" value="Nuts" class="tag">Nuts </div>
    <div class="filterButton" id="Lactose" onclick="checkTag('Lactose')">
    <input hidden type="checkbox" name="Lactose" value="Lactose" class="tag">Lactose </div>
    <div class="filterButton" id="Gluten" onclick="checkTag('Gluten')">
    <input hidden  type="checkbox" name="Gluten" value="Gluten" class="tag">Gluten </div>
    
    
</div>

<button class="collapsible" onclick="collapsible()">Lifestyle </button>
<div class="content">
    
<div class="filterButton" id="Vegan" onclick="checkTag('Vegan')">
    <input hidden  type="checkbox" name="Vegan" value="Vegan" class="tag">Vegan </div>
    <div class="filterButton" id="Vegetarian" onclick="checkTag('Vegetarian')">
    <input hidden  type="checkbox" name="Vegetarian" value="Vegetarian" class="tag">Vegetarian </div>
    <div class="filterButton" id="Pescaterian" onclick="checkTag('Pescaterian')">
    <input hidden  type="checkbox" name="Pescaterian" value="Pescaterian" class="tag">Pescaterian </div>
    
</div>

<button class="collapsible" onclick="collapsible()">Cuisine </button>
<div class="content">
   
<div class="filterButton" id="Mexican" onclick="checkTag('Mexican')">
    <input hidden  type="checkbox" name="Mexican" value="Mexican" class="tag">Mexican </div>
    <div class="filterButton" id="Indian" onclick="checkTag('Indian')">
    <input hidden  type="checkbox" name="Indian" value="Indian" class="tag">Indian </div>
    <div class="filterButton" id="Chinese" onclick="checkTag('Chinese')">
    <input hidden  type="checkbox" name="Chinese" value="Chinese" class="tag">Chinese </div>
    <div class="filterButton" id="Italian" onclick="checkTag('Italian')">
    <input hidden  type="checkbox" name="Italian" value="Italian" class="tag">Italian </div>
  
  
    
</div>

<button class="collapsible" onclick="collapsible()">Easy to make </button>
<div class="content">
  
<div class="filterButton" id="Salad" onclick="checkTag('Salad')">
    <input hidden  type="checkbox" name="Salad" value="Salad" class="tag">Salad </div>
    <div class="filterButton" id="Sandwiches" onclick="checkTag('Sandwiches')">
    <input hidden  type="checkbox" name="Sandwiches" value="Sandwiches" class="tag">Sandwiches </div>
 

    
    
</div>

<button class="collapsible" onclick="collapsible()">Cooking method </button>
<div class="content">
   
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

<button class="collapsible" onclick="collapsible()">Sort </button>
<div class="content">
   
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
   <br>
    
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>









<!--
<div class="filterHead">
  <div class="dropdownFilter">
    <button class="dropButtonFilter">Meat 
     
    </button>
    <div class="dropdownFilter-filterBox">
        <div class="filterButton" id="Chicken" onclick="checkTag('Chicken')" onmouseover="hoverIn(this)" onmouseout="hoverOut(this)">
        <input hidden id="filterButton" type="checkbox" name="Chicken" value="Chicken" class="tag">Chicken </div>
    
    <div class="filterButton" id="Pork" onclick="checkTag('Pork')">
    <input hidden id="filterButton" type="checkbox" name="Pork" value="Pork" class="tag">Pork </div>
    
    <div class="filterButton" id="Beef" onclick="checkTag('Beef')">
    <input hidden id="filterButton" type="checkbox" name="Beef" value="Beef" class="tag">Beef </div>
    </div>
  </div>
  
      <div class="dropdownFilter">
    <button class="dropButtonFilter">Fish 
     
    </button>
    <div class="dropdownFilter-filterBox">
<div class="filterButton" id="Cod" onclick="checkTag('Cod')">
    <input hidden id="filterButton" type="checkbox" name="Cod" value="Cod" class="tag">Cod </div>
<div class="filterButton" id="Salmon" onclick="checkTag('Salmon')">
    <input hidden id="filterButton" type="checkbox" name="Salmon" value="Salmon" class="tag">Salmon </div>
<div class="filterButton" id="Tuna" onclick="checkTag('Tuna')">
    <input hidden id="filterButton" type="checkbox" name="Tuna" value="Tuna" class="tag">Tuna </div>
    </div>
</div>

        


 </div>-->



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
        

        
        
        
        
        
        
       
        </div>    
        <!-- /.col-lg-3 -->
        <div class="col-lg-2"></div>
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
