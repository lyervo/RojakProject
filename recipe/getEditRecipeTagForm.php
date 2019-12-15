<?php

    $result = getTagByRecipeID($recipe_id);
    $count = getTagCountByID($recipe_id);
    if($count == 0)
    {
        $count = 1;
    }
    if(!empty($result))
    {
        $response = "";
        $i = 1;

        foreach($result as $res)
        {
            $response = $response.generateTagInputGroup($i, $res);
            $i = $i + 1;
        }
        
        $response = $response."<input type='hidden' id='tagCount' value='".$count."'>";
        echo $response;
    }else
    {
        echo '<div><input id="tag1" type="text"><div id="suggestTag1"></div><button>Remove Tag</button><br></div>'
            ."<input type='hidden' id='tagCount' value='".$count."'>";
    }
    
    ?>
