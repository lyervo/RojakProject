<?php

function generateIngredientInputGroup($i,$ingredient)
{
    require_once 'recipe_db.php';
    
    if($ingredient['modifier'] != "null")
    {
        $mod = $ingredient['modifier'];
    }else
    {
        $mod = "";
    }
    
    
    $response = '<div>'
            . '<input id="ingredientName'.$i.'" type="text" placeholder="Enter ingredient '.$i.'..." value="'.getIngredientNameByID($ingredient['ingredient_id']).'" onipunt="suggestIngredient('.$i.')">'
            . '<div id="suggest'.$i.'"></div>'
            . '<input id="ingredientAmount'.$i.'" type="number" placeholder="Enter amount..." min="1" value="'.$ingredient['amount'].'">'
            . '<input id="ingredientUnit'.$i.'" type="text" placeholder="In what unit..." value="'.$ingredient['unit'].'">'
            . '<input id="ingredientMod'.$i.'" type="text" placeholder="Modifiers(Chopped?Diced?Blended?)" value="'.$mod.'">'
            . '<button onclick="removeIngredient('.$i.')">Remove Ingredient</button></div>';
    return $response;
}

function generateStepInputGroup($i,$step)
{
    require_once 'recipe_db.php';
    
    $response = '<div id="stepInputGroup'.$i.'">'
            . '<input id="step'.$i.'" type="text" placeholder="Enter step '.$i.'..." value="'.$step['description'].'">';
    
    if($step['step_image'] == "null" || $step['step_image'] == null)
    {
        $response = $response.'<img id="stepImagePreview'.$i.'" height="200" class="previewImage" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">';
    }else
    {
        $response = $response.'<img id="stepImagePreview'.$i.'" height="200" class="previewImage" src="data:image/jpeg;base64,' . base64_encode($step['step_image']) . '">';
    }
    $response = $response. 'Upload an image for Step '.$i.':<input id="stepImage'.$i.'" type="file"  onchange="checkFile(this)">'
            . '<button onclick="removeStep('.$i.')">Remove Step '.$i.'</button></div>';
    return $response;
}

function generateTagInputGroup($i,$tag)
{
    require_once 'recipe_db.php';
    $tag_name = getTagNameById($tag['tag_id']);
    $response = '<div id="tagInputGroup'.$i.'"><input id="tag'.$i.'" type="text" value="'.$tag_name.'" onchange="suggestTag('.$i.')">'
            . '<div id="suggestTag'.$i.'"></div>'
            . '<button onclick="removeTag('.$i.')">Remove Tag</button><br></div>';
    return $response;
}
