<?php

    include "../model/db_connect.php";
    require_once '../recipe/recipe_db.php';
    require_once '../recipe/recipe_input_group.php';
    $recipe_id = $_REQUEST['recipe_id'];
    
    $recipe = getRecipeByID($recipe_id);
    
    include "header.php";
    
?>
    <script>
    
    
        var ingredientTab;
        var stepTab;
        var tagTab;
        
        var firstRun;
    
        var ingredientAjax = [];
        var stepAjax = [];
        var tagAjax = [];
        var user_id;
        
        var br;
    
        function checkDuplicateName()
        {


            var name = document.getElementById("recipeName").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    if (this.responseText == -1)
                    {

                        document.getElementById("nameWarning").innerHTML = "";
                        return false;
                    } else
                    {

                        document.getElementById("nameWarning").innerHTML = "Duplicate recipe name, please use a different name.";
                        return true;
                    }
                }
            };
            xmlhttp.open("GET", "../recipe/checkRecipeName.php?recipe_name="+name, true);
            xmlhttp.send();
        }
    
        function init()
        {
            document.getElementById("recipeName").addEventListener("input",checkDuplicateNameExceptOwn());
            br = document.createElement("br");
            checkLoginStatus(0);
            stepTab = document.getElementById("stepCount").value;
            ingredientTab = document.getElementById("ingredientCount").value;
            tagTab = document.getElementById("tagCount").value;
            resetSrc();
            
        }
        
        function suggestIngredient(i)
        {

            var name = document.getElementById("ingredientName" + i).value;

            if (name.length <= 3)
            {

                return;
            } else
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function ()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("suggest" + i).innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "../recipe/suggest_ingredient.php?name=" + name +"&id=ingredientName"+i, true);
                xmlhttp.send();
            }
        }

        function suggestTag(i)
        {


            var name = document.getElementById("tag" + i).value;

            if (name.length <= 3)
            {

                return;
            } else
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function ()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {

                        console.log(this.responseText);
                        document.getElementById("suggestTag" + i).innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "../recipe/suggest_tag.php?name=" + name +"&id=tag"+i, true);
                xmlhttp.send();
            }
        }
        
        function checkLoginStatus(task)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    if (this.responseText >= 1)
                    {
                        
                        if(task===1)
                        {
                            submitData();
                        }else
                        {
                            
                        }
                        
                        

                    } else
                    {
                        alert("You must be the author of this recipe or have admin status to log in.");
                        window.close();
                    }
                }
            };
            xmlhttp.open("GET", "../user/checkLoginStatus.php", true);
            xmlhttp.send();
        }
        
        
        
        
        function checkFile(input)
        {
            var imgSrc = window.URL;

            var file = input.files[0];

            if (file)
            {

                var idText = input.id;

                var idNum = idText.charAt(idText.length-1);

                var preview = document.getElementById("stepImagePreview"+idNum);

                preview.style.height = "200px";

                var image = new Image();

                image.onload = function() {
                    if (this.height&&this.width)
                    {
                        preview.src = image.src;
                    }else
                    {
                        console.log("invalid input");
                    }
                };

                image.src = URL.createObjectURL(file);
            }


        }
        
        
        function resetSrc()
        {
            
            var doms = [];
            
            for (var i = 1; i <= stepTab; i++)
                {

                    var value = document.getElementById("step"+i).value;

                    var img = document.getElementById("stepImagePreview"+i).src;




                    
                    doms.push(createStepInputGroup(i,value,img));
                    
                }

                stepSpace.innerHTML = "";

                for(var i=0;i<doms.length;i++)
                {
                    stepSpace.appendChild(doms[i]);
                }
        }
        
        function createStepInputGroup(i,value,src)
        {
            
            //creating a group of inputs use for processing a step data
            var step = createElement("div");

            step.id = "stepInputGroup"+i;

            var stepTextInput = createElement("input","step"+i);

            stepTextInput.setAttribute("type","text");

            stepTextInput.setAttribute("placeholder","Enter step "+i+"...");

            if(value!=null)
            { 
                stepTextInput.setAttribute("value",value);
            }

            var previewImg = createElement("img","stepImagePreview"+i);
            if(src!=null)
            {
                previewImg.src = src;
            }

            previewImg.setAttribute("height","200");

            previewImg.className = "previewImage";

            var text = document.createTextNode("Upload an image for Step "+i+":");


            var stepImageInput = createElement("input","stepImage"+i,null,"change",function(){ checkFile(stepImageInput); });

            stepImageInput.setAttribute("type","file");

            var removeButton = createElement("button",null,null,"click",function(){ removeStep(i); });
            removeButton.innerHTML = "Remove Step "+i;

            step.appendChild(stepTextInput);
            step.appendChild(br);
            step.appendChild(previewImg);
            step.appendChild(br);
            step.appendChild(text);
            step.appendChild(stepImageInput);
            step.appendChild(br);
            step.appendChild(removeButton);
            step.appendChild(br);
            return step;

        }

        function createTagInputGroup(i,value)
        {
            
            var tag = createElement("div");

            var textInput = createElement("input", "tag"+i,null,"change",function() { suggestTag(i); });
            textInput.setAttribute("type","text");

            if(value!=null&&value!="")
            {
                textInput.value = value;
            }

            var suggestDiv = createElement("div","suggestTag"+i);

            var removeButton = createElement("button",null,null,"click", function(){ removeTag(i); });

            removeButton.innerHTML = "Remove Tag";

            tag.appendChild(textInput);
            tag.appendChild(br);
            tag.appendChild(suggestDiv);
            tag.appendChild(br);
            tag.appendChild(removeButton);
            tag.appendChild(br);

            return tag;


        }

        function createIngredientInputGroup(i,value1,value2,value3,value4)
        {
            
            var ingredient = createElement("div");

            var nameInput = createElement("input","ingredientName"+i,null,"input",function(){ suggestIngredient(i); });
            nameInput.setAttribute("type","text");
            nameInput.setAttribute("placeholder","Enter ingredient "+i+"...");


            if(value1!=null)
            {
                nameInput.value = value1;
            }


            var suggestDiv = createElement("div","suggest"+i);


            var amountInput = createElement("input","ingredientAmount"+i);
            amountInput.setAttribute("type","number");
            amountInput.setAttribute("placeholder","Enter amount...");
            amountInput.setAttribute("min","1");

            if(value2!=null)
            {
                amountInput.value = value2;
            }

            var unitInput = createElement("input","ingredientUnit"+i);
            unitInput.setAttribute("type","text");
            unitInput.setAttribute("placeholder","In what unit...");

            if(value3!=null)
            {
                unitInput.value = value3;
            }

            var modInput = createElement("input","ingredientMod"+i);
            modInput.setAttribute("type","text");
            modInput.setAttribute("placeholder","Modifiers(Chopped?Diced?Blended?)");

            if(value4!=null)
            {
                modInput.value = value4;
            }

            var removeButton = createElement("button",null,null,"click",function(){ removeIngredient(i); });
            removeButton.innerHTML = "Remove Ingredient";

            ingredient.appendChild(nameInput);
            ingredient.appendChild(br);
            ingredient.appendChild(suggestDiv);
            ingredient.appendChild(amountInput);
            ingredient.appendChild(unitInput);
            ingredient.appendChild(modInput);
            ingredient.appendChild(removeButton);
            ingredient.appendChild(br);

            return ingredient;
        }

        function createElement(type,id,className,event,func)
        {
            
            var obj = document.createElement(type);
            if(id!=null)
            {
                obj.id = id;
            }

            if(className!=null)
            {
                obj.className = className;
            }

            if(event!=null&&func!=null)
            {
                obj.addEventListener(event,func);
            }

            return obj;
        }

        function addTagTab()
        {
            
            tagTab++;

            document.getElementById("tagSpace").appendChild(createTagInputGroup(tagTab));
        }

        function addIngredientTab()
        {
            
            var ingredientSpace = document.getElementById("ingredientSpace");

            ingredientTab++;

            ingredientSpace.appendChild(createIngredientInputGroup(ingredientTab));


        }

        function removeIngredient(index)
        {
            
            if (ingredientTab > 1)
            {
                var doms = [];
                var ingredientSpace = document.getElementById("ingredientSpace");
                var removed = false;
                for (var i = 1; i <= ingredientTab; i++)
                {
                    var ingredientName = document.getElementById("ingredientName" + i).value;
                    var ingredientAmount = document.getElementById("ingredientAmount" + i).value;
                    var ingredientUnit = document.getElementById("ingredientUnit" + i).value;
                    var ingredientMod = document.getElementById("ingredientMod" + i).value;
                    if (i == index)
                    {
                        removed = true;
                    } else if (!removed)
                    {

                        doms.push(createIngredientInputGroup(i,ingredientName,ingredientAmount,ingredientUnit,ingredientMod));



                    } else if (removed)
                    {
                        doms.push(createIngredientInputGroup(i-1,ingredientName,ingredientAmount,ingredientUnit,ingredientMod));

                    }
                }
                ingredientTab--;
                ingredientSpace.innerHTML = "";

                for(var i=0;i<doms.length;i++)
                {
                    ingredientSpace.appendChild(doms[i]);
                }

            }

        }

        function addStepTab()
        {

            
            var stepSpace = document.getElementById("stepSpace");

            stepTab++;

            stepSpace.appendChild(createStepInputGroup(stepTab));




        }

        function removeStep(index)
        {
            
            var stepSpace = document.getElementById("stepSpace");

            var doms = [];

            if (stepTab > 1)
            {
                var removed = false;


                for (var i = 1; i <= stepTab; i++)
                {

                    var value = document.getElementById("step"+i).value;

                    var img = document.getElementById("stepImagePreview"+i).src;




                    if (index == i)
                    {

                        removed = true;

                    } else if (!removed)
                    {
                        doms.push(createStepInputGroup(i,value,img));
                    } else if (removed)
                    {
                        doms.push(createStepInputGroup(i-1,value,img));
                    }
                }
                stepTab--;
                stepSpace.innerHTML = "";

                for(var i=0;i<doms.length;i++)
                {
                    stepSpace.appendChild(doms[i]);
                }

            }
        }

        function removeTag(index)
        {
            
            var tagSpace = document.getElementById("tagSpace");
            if (tagTab > 1)
            {
                var doms = [];
                var removed = false;
                for (var i = 1; i <= tagTab; i++)
                {
                    var value = document.getElementById("tag"+i).value;
                    if (index == i)
                    {
                        removed = true;
                    } else if (!removed)
                    {
                        doms.push(createTagInputGroup(i,value));
                    } else if (removed)
                    {
                        doms.push(createTagInputGroup(i-1,value));
                    }
                }
                tagTab--;
                tagSpace.innerHTML = "";
                for(var i=0;i<doms.length;i++)
                {
                    tagSpace.appendChild(doms[i]);
                }
            }

        }
        
        function checkDuplicateNameExceptOwn()
        {


            var name = document.getElementById("recipeName").value;
            
            if(name=="<?php echo $recipe['recipe_name'] ?>")
            {
                document.getElementById("nameWarning").innerHTML = "";
                return;
            }
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    if (this.responseText == -1)
                    {

                        document.getElementById("nameWarning").innerHTML = "";
                        return false;
                    } else
                    {

                        document.getElementById("nameWarning").innerHTML = "Duplicate recipe name, please use a different name.";
                        return true;
                    }
                }
            };
            xmlhttp.open("GET", "../recipe/checkRecipeName.php?recipe_name="+name+"&orignal_name=<?php echo $recipe['recipe_name'] ?>", true);
            xmlhttp.send();
        }
        
    

    function submitData()
    {

        tagAjax = [];
        stepAjax = [];
        ingredientAjax = [];
        
        
        if(checkDuplicateNameExceptOwn())
        {
            alert("Duplicate name, please try again");
            return;
        }

        var time = document.getElementById("recipeTime").value;
        var recipeName = document.getElementById("recipeName").value;
        var recipeDesc = document.getElementById("recipeDesc").value;
        var recipeServing = document.getElementById("recipeServing").value;
        var difficulty = document.getElementById("difficulty").value;

        if (recipeName === "" || recipeDesc === "" || recipeServing === "")
        {
            alert("Missing Recipe information please try again.");
            return;
        }






        for (var i = 1; i <= ingredientTab; i++)
        {
            var ingredientName = document.getElementById("ingredientName" + i).value;
            var ingredientAmount = document.getElementById("ingredientAmount" + i).value;
            var ingredientUnit = document.getElementById("ingredientUnit" + i).value;
            var ingredientMod = document.getElementById("ingredientMod" + i).value;

            if (ingredientName === "" || ingredientAmount === "")
            {
                alert("Missing ingredient name/amount, please try again.");
                return;
            }


            if (ingredientUnit === "")
            {
                ingredientUnit = "null";
            }

            if (ingredientMod === "")
            {
                ingredientMod = "null";
            }

            



            ingredientAjax.push("name=" + ingredientName + "&amount=" + ingredientAmount + "&unit=" + ingredientUnit + "&mod=" + ingredientMod );

        }
        
        






        for (var i = 1; i <= tagTab; i++)
        {
            var tag = "tag=" + document.getElementById("tag" + i).value;
            if (tag === "")
            {
                alert("Empty fields in tag, please try again.");
                return;
            }

            tagAjax.push(tag);
        }


        var noTags = document.getElementsByClassName("noTag");

        for (var i = 0; i < noTags.length; i++)
        {
            if (noTags[i].checked)
            {

                tagAjax.push("tag=" + noTags[i].value);

            }
        }

        ajaxRecipeRequest();
    }
    
        function insertIngredientStep(recipeID)
        {
        
       
            for (var i = 0; i < ingredientAjax.length; i++)
            {
                ajaxRecipeIngredientRequest(ingredientAjax[i] + "&recipeID=" + recipeID);
                console.log(ingredientAjax[i] + "&recipeID=" + recipeID);
            }

            ajaxRecipeStepRequest(recipeID);

            for (var i = 0; i < tagAjax.length; i++)
            {
                ajaxRecipeTagRequest(tagAjax[i] + "&recipe_id=" + recipeID);
            }
        }
    
        function ajaxRecipeStepRequest(id)
        {
            
        
            for (var i = 1; i <= stepTab; i++)
            {
                //preBlobStepRequest -> postBlobStepRequest -> Finish operation
                preBlobStepRequest(i,"stepImagePreview"+i,id);

            }




        }
    
    //this function is call to check if a step input group has an uploaded image, 
    //if so, the image src is converted into a canvas which is then converted 
    //into a blob to upload it to the database
    
    function preBlobStepRequest(i,imgId,recipeId)
    {
        
        var image = document.getElementById(imgId);
                
        
        
        if(data = "")
        {
            //not performing any action since there is no image for uploading
            postBlobStepRequest(i,recipeId);
            return;
        }
                
        var img = new Image();
        var c = document.createElement("canvas");
        var ctx = c.getContext("2d");
        img.onload = function ()
        {
            c.width = this.naturalWidth;     
            c.height = this.naturalHeight;
            ctx.drawImage(this, 0, 0);       
            c.toBlob(function (blob)
            {        
                postBlobStepRequest(i,recipeId,blob);
            }, "image/jpeg", 0.75);
        };
        img.crossOrigin = "";             
        
        img.src = image.src;
    }
    
    
    //send the insert request to the backend, optionally contains the blob image
    function postBlobStepRequest(i,recipeId,blob)
    {
        var formData = new FormData();

            var step = document.getElementById("step" + i).value;
            
            formData.append("step", step);
            formData.append("recipe_id", recipeId);

            
            if (blob != null)
            {
               formData.append('step_image', blob, "step_image");
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    
                }
            };
            
            xmlhttp.open("POST", "../recipe/create_recipe_step.php", true);
            xmlhttp.send(formData);
    }

    function ajaxRecipeRequest()
    {
        var time = document.getElementById("recipeTime").value;
        var recipeName = document.getElementById("recipeName").value;
        var recipeDesc = document.getElementById("recipeDesc").value;
        var recipeServing = document.getElementById("recipeServing").value;
        var difficulty = document.getElementById("difficulty").value;
        var youtube = document.getElementById("youtube").value;

        if(youtube == "")
        {
            youtube = "null";
        }

        var formData = new FormData();

        var imageFileInput = document.getElementById('image_file');
        if (imageFileInput.value.length > 0)
        {
            var image_file = imageFileInput.files[0];
            
            formData.append('image_file', image_file, "recipe_image");
        }
        formData.append('time', time);
        formData.append('recipe_name', recipeName);
        formData.append('desc', recipeDesc);
        formData.append('serving', recipeServing);
        formData.append('difficulty', difficulty);
        formData.append('recipe_id',<?php echo $recipe_id; ?>);
        formData.append('youtube',youtube);






        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
              
         
                
            }
        };
        xmlhttp.onload = function ()
        {
            insertIngredientStep(this.responseText);
        };
        xmlhttp.open("POST", "../recipe/edit_recipe.php", true);
        xmlhttp.send(formData);



    }

    function ajaxRecipeIngredientRequest(request)
    {
        console.log(request);
        if (request.length == 0)
        {
            alert("error in recipe ingredient request");
            return;
        } else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    
                }
            };
            xmlhttp.open("GET", "../recipe/create_recipe_ingredient.php?" + request, true);
            xmlhttp.send();
        }


    }

    

    function ajaxRecipeTagRequest(request)
    {

        if (request.length == 0)
        {
            alert("error in recipe tag request");
            return;

        } else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    console.log(this.responseText);
                }
            };
            xmlhttp.open("GET", "../recipe/create_recipe_tag.php?" + request, true);
            xmlhttp.send();
        }


    }
    
    function loadPreview(input)
    {
        var imgSrc = window.URL;
        
        var file = input.files[0];

        if (file)
        {
            
            
            var preview = document.getElementById("previewImageMain");
            
            preview.style.height = "200px";

            var image = new Image();

            image.onload = function() {
                if (this.height&&this.width)
                {
                    preview.src = image.src;
                }else
                {
                    console.log("invalid input");
                }
            };

            image.src = URL.createObjectURL(file);
        }
    }
    
    
        
        
    
    </script>
    <body onload="init()">
        <div class="container">

    <div class="row">
        <div class="col-lg-10">

            <p>Submit an image of the recipe</p>
            <?php
            
                if($recipe['image_blob'] == null || $recipe['image_blob'] == "null")
                {
                    echo "<img id='previewImageMain'>";
                } else
                {
                    echo '<img id="previewImageMain" src="data:image/jpeg;base64,' . base64_encode($recipe['image_blob']) . '" >';
                }
            
            ?>
            <input type="file" name="image_file" id="image_file" onchange="loadPreview(this)">
            <br>
            <input type="text" placeholder="Recipe Name" id="recipeName" value="<?php echo $recipe['recipe_name']; ?>">
            <br>
            <p id="nameWarning"></p>
            <br>
            <input type="text" placeholder="Recipe Description" id="recipeDesc" value="<?php echo $recipe['description']; ?>">
            <br>
            <input type="number" placeholder="Recommended servings" id="recipeServing" min="1" value="<?php echo $recipe['serving']; ?>">
            <br>
            <select id="difficulty">
                <option value="easy" <?php if($recipe['difficulty']=="easy"){ echo "selected"; } ?> >College Student(Easy)</option>
                <option value="medium" <?php if($recipe['difficulty']=="medium"){ echo "selected"; } ?> >>Chef(Medium)</option>
                <option value="hard" <?php if($recipe['difficulty']=="hard"){ echo "selected"; } ?> >>Michelin Chef(Hard)</option>
            </select>
            <br>
            <input type="number" placeholder="Cooking time(Minutes)" id="recipeTime" min="1" value="<?php echo $recipe['cooking_time']; ?>">
            <br>
            <br>
            <div id="ingredientSpace">
                
                <?php include "../recipe/getEditRecipeIngredientForm.php"; ?>
                
            </div>
            <button onclick="addIngredientTab()">Add Ingredient</button>
            <div id="stepSpace">
                
                <?php include "../recipe/getEditRecipeStepForm.php"; ?>
                
            </div>
            <button onclick="addStepTab()">Add Step</button>
            <br>
            <br>
            <div id="tagSpace">
                
                <?php include "../recipe/getEditRecipeTagForm.php"; ?>
                
            </div>
            <button onclick="addTagTab()">Add Tag</button>
            <br>
            <div>
            <p>Exclude:</p>
            <p style="color:red">Attention: Please check the following check boxes to warn users of allergen risks, recipes without correct allergen warning is a threat to other user's health and safety and therefore any recipe without correct allergen warning will be taken down by the Admin.</p>
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
            <input type="checkbox" value="no_shellfish" class="noTag">Shellfish<br>

            
            <p>Optional: Provide a You Tube tutorial video</p>
            <input tyep="text" id="youtube" placeholder="Paste link here..." value="<?php echo $recipe['youtube']; ?>">
            
            <br>
            
            <button onclick="checkLoginStatus(1)">Submit Recipe</button>
            </div>
        </div>
    </div>
</div>
        
    </body>
</html>