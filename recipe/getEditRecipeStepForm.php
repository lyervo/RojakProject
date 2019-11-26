<?php

    
    $result = getStepByID($recipe_id);
    $count = getStepCountByID($recipe_id);
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
            $response = $response.generateStepInputGroup($i, $res);
            $i = $i + 1;
        }
        
        $response = $response."<input type='hidden' id='stepCount' value='".$count."'>";
        echo $response;
    }else
    {
        echo '<div id="stepInputGroup1">'
        . '<input id="step1" type="text" placeholder="Enter step 1...">'
                . '<img id="stepImagePreview1" height="200" class="previewImage" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">'
                . 'Upload an image for Step 1:<input id="stepImage1" type="file" onchange="checkFile(this)">'
                . '<button onclick="removeStep(1)">Remove Step 1</button></div>'
                ."<input type='hidden' id='stepCount' value='".$count."'>";
    }