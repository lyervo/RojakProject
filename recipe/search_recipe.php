<?php 

    include "../model/db_connect.php";
    
    require "recipe_db.php";
    
    $term = $_REQUEST['term'];
    $sort = $_REQUEST['sort'];
    $order = $_REQUEST['order'];    
    $tag = $_REQUEST['tag'];
    $noTag = $_REQUEST['noTag'];
    

    
    
    if($tag === "null")
    {
        $tagString = "";
    }else
    {
        echo "run";
        $tags = explode("%%", $tag);
        $tagString = " and (";
    
        $first = true;
        
        foreach($tags as $t)
        {
            if($first)
            {
                $tagString = $tagString." tag.tag_name='".$t."'";
                $first = false;
            }else
            {
                $tagString = $tagString." or tag.tag_name='".$t."'";
            }
        }
        
        $tagString=$tagString.")";
    }
    
    if($noTag === "null")
    {
        $noTagString = "";
    }else
    {
        echo "reeeeeee";
        $noTags = explode("%%", $noTag);
        $noTagString = " and (";
    
        $first = true;
        
        foreach($noTags as $t)
        {
            if($first)
            {
                $noTagString = $noTagString." tag.tag_name='".$t."'";
                $first = false;
            }else
            {
                $noTagString = $noTagString." and tag.tag_name='".$t."'";
            }
        }
        
        $noTagString=$noTagString.")";
    }
    

    
    
    if($sort === "date")
    {
        $result = searchRecipeOrderByDate($term,$order,$tagString,$noTagString);
    }else if($sort === "rating")
    {
        $result = searchRecipeOrderByRating($term,$order,$tagString,$noTagString);
    }else if($sort === "ingredient")
    {
        $result = searchRecipeOrderByIngredient($term,$order,$tagString,$noTagString);
    }else if($sort === "time")
    {
        $result = searchRecipeOrderByTime($term,$order,$tagString,$noTagString);
    }else if($sort === "name")
    {
        $result = searchRecipeOrderByName($term,$order,$tagString,$noTagString);
    }
    
    
    
    
    
    $response = "";
    
    
    foreach ($result as $res)
    {
        $response = $response."<p><h2><a href='view_recipe.php?id=".$res['recipe_id']."'>".$res['recipe_name']."</h2></a></p><p>".$res['description']."</p>";
    }
    
    
    echo $response;

?>