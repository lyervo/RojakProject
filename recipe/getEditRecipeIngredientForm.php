<?php

    $count = getIngredientCountByID($recipe_id);
    $result = getIngredientByRecipeID($recipe_id);
    
    $i = 1;
    $response = "";
    if(!empty($result))
    {
        foreach($result as $res)
        {
            $response = $response.generateIngredientInputGroup($i, $res);
            $i = $i + 1;
        }
        
        $response = $response."<input type='hidden' id='ingredientCount' value='".$count."'>";
        echo $response;
        
    } else
    {
        echo '<div><input id="ingredientName1" type="text" placeholder="Enter ingredient 1...">'
        . '<div id="suggest1"></div>'
                . '<input id="ingredientAmount1" type="number" placeholder="Enter amount..." min="1">'
                . '<input id="ingredientUnit1" type="text" placeholder="In what unit...">'
                . '<input id="ingredientMod1" type="text" placeholder="Modifiers(Chopped?Diced?Blended?)">'
                . '<button onclick="removeIngredient(1)">Remove Ingredient</button></div>'
                ."<input type='hidden' id='ingredientCount' value='".$count."'>";
    }
    
    