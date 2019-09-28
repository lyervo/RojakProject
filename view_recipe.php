<?php

    include "db_connect.php";
    require "recipe/recipe_db.php";
    
    $id = $_REQUEST['id'];

    $recipe = getRecipeByID($id);
    
    $ingredients = getRecipeIngredientByID($id);
    
    $steps = getStepByID($id);
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $recipe['recipe_name']; ?></title>
    </head>
    <body>
        <h2>Recipe Name: <?php echo $recipe['recipe_name']; ?></h2>
        <p>Recommended Amount of Servings: <?php echo $recipe['serving'] ?></p>
        <p>Recipe Description :<?php echo $recipe['description'] ?></p>
        
        
        
        <?php
        
            foreach($ingredients as $ing)
            {
                $ingredient_name = getIngredientNameByID($ing['ingredient_id']); 
                
                echo "<p>".$ingredient_name.", ".$ing['amount'];
                
                if($ing['unit']!="null")
                {
                    echo " ".$ing['unit'];
                }
                
                if($ing['modifier']!="null")
                {
                    echo ",".$ing['modifier'];
                }
                        
                echo "</p>";
                
            }
            
            $num = 1;
            
            foreach($steps as $step)
            {
                echo "<p>".$num.". ".$step['description']."</p>";
                $num += 1;
            }
        
        
        ?>
        
        
    </body>
</html>
