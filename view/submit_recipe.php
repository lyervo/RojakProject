<?php
$current = 'user';
include 'header.php';
?>

<script>
    var ingredientTab = 1;
    var stepTab = 1;
    var tagTab = 1;

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
        xmlhttp.open("GET", "../recipe/checkRecipeName.php?recipe_name=" + name, true);
        xmlhttp.send();
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

            xmlhttp.open("GET", "../recipe/suggest_ingredient.php?name=" + name + "&id=ingredientName" + i, true);
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

            xmlhttp.open("GET", "../recipe/suggest_tag.php?name=" + name + "&id=tag" + i, true);
            xmlhttp.send();
        }
    }

    function insertIngredientStep(recipeID)
    {
        for (var i = 0; i < ingredientAjax.length; i++)
        {
            ajaxRecipeIngredientRequest(ingredientAjax[i] + "&recipeID=" + recipeID);
        }

        ajaxRecipeStepRequest(recipeID);

        for (var i = 0; i < tagAjax.length; i++)
        {
            ajaxRecipeTagRequest(tagAjax[i] + "&recipe_id=" + recipeID,i);
        }
        
        setTimeout(function(){
           alert("Operation complete");
           window.location.href("../controller/index.php?action=user_profile")
        });
        
    }

    function ajaxRecipeStepRequest(id)
    {


        for (var i = 1; i <= stepTab; i++)
        {
            //preBlobStepRequest -> postBlobStepRequest -> Finish operation
            preBlobStepRequest(i, "stepImagePreview" + i, id);

        }




    }

    //this function is call to check if a step input group has an uploaded image, 
    //if so, the image src is converted into a canvas which is then converted 
    //into a blob to upload it to the database

    function preBlobStepRequest(i, imgId, recipeId)
    {
        var image = document.getElementById(imgId);




        if (image.src == "")
        {

            //not performing any action since there is no image for uploading
            postBlobStepRequest(i, recipeId);
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
                postBlobStepRequest(i, recipeId, blob);
            }, "image/jpeg", 0.75);
        };
        img.crossOrigin = "";
        img.src = image.src;
    }


    //send the insert request to the backend, optionally contains the blob image
    function postBlobStepRequest(i, recipeId, blob)
    {

        var formData = new FormData();

        var step = document.getElementById("step" + i).value;

        formData.append("step", step);
        formData.append("recipe_id", recipeId);
        formData.append("step_order", i);


        if (blob != null)
        {
            formData.append('step_image', blob, "step_image");
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                console.log(step);
                
            }
        };

        xmlhttp.open("POST", "../recipe/create_recipe_step.php", true);
        xmlhttp.send(formData);
    }

    function ajaxRecipeRequest(blob)
    {
        var time = document.getElementById("recipeTime").value;
        var recipeName = document.getElementById("recipeName").value;
        var recipeDesc = document.getElementById("recipeDesc").value;
        var recipeServing = document.getElementById("recipeServing").value;
        var difficulty = document.getElementById("difficulty").value;
        var youtube = document.getElementById("youtube").value;


        if (youtube == "")
        {
            youtube = "null";
        }

        var formData = new FormData();


        if (blob != null)
        {

            formData.append('image_file', blob, "recipe_image");
        }
        formData.append('time', time);
        formData.append('name', recipeName);
        formData.append('desc', recipeDesc);
        formData.append('serving', recipeServing);
        formData.append('difficulty', difficulty);
        formData.append('youtube', youtube);
        formData.append('id', user_id);







        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {

                console.log(this.responseText);
            }
        };
        xmlhttp.onload = function ()
        {
            insertIngredientStep(this.responseText);
        };
        xmlhttp.open("POST", "../recipe/create_recipe.php", true);
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

    function checkPreviewImage()
    {
        var image = document.getElementById("previewImageMain");

        var data = image.src;

        if (data == "")
        {
            //not performing any action since there is no image for uploading
            console.log("no image");
            ajaxRecipeRequest();
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
                console.log("image");
                ajaxRecipeRequest(blob);
            }, "image/jpeg", 0.75);
        };
        img.crossOrigin = "";

        img.src = image.src;
    }

    function removeImage(i)
    {
        document.getElementById("stepImagePreview" + i).src = "#";
    }

    function initTab()
    {

        br = document.createElement("br");

        document.getElementById("ingredientSpace").appendChild(createIngredientInputGroup(1));
        document.getElementById("stepSpace").appendChild(createStepInputGroup(1));
        document.getElementById("tagSpace").appendChild(createTagInputGroup(1));

    }

    function createStepInputGroup(i, value, src)
    {

        //creating a group of inputs use for processing a step data
        var step = createElement("div");

        step.id = "stepInputGroup" + i;

        var stepTextInput = createElement("input", "step" + i);

        stepTextInput.setAttribute("type", "text");

        stepTextInput.setAttribute("placeholder", "Enter step " + i + "...");

        if (value != null)
        {
            stepTextInput.setAttribute("value", value);
        }

        var previewImg = createElement("img", "stepImagePreview" + i);
        if (src != null)
        {
            previewImg.src = src;
        }

        previewImg.setAttribute("height", "160px");
        previewImg.setAttribute("width", "250px");

        previewImg.className = "previewImage";

        var text = document.createTextNode("  Upload an image for Step " + i + ":  ");


        var stepImageInput = createElement("input", "stepImage" + i, null, "change", function () {
            checkFile(stepImageInput);
        });
        stepImageInput.addEventListener("click", function () {
            removeImage(i);
        });

        stepImageInput.setAttribute("type", "file");

        var removeButton = createElement("button", null, "btn btn-warning", "click", function () {
            removeStep(i);
        });

        removeButton.innerHTML = "Remove Step " + i;


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

    function createTagInputGroup(i, value)
    {

        var tag = createElement("div");

        var textInput = createElement("input", "tag" + i, null, "change", function () {
            suggestTag(i);
        });
        textInput.setAttribute("type", "text");

        if (value != null && value != "")
        {
            textInput.value = value;
        }

        var suggestDiv = createElement("div", "suggestTag" + i);

        var removeButton = createElement("button", null, null, "click", function () {
            removeTag(i);
        });

        removeButton.innerHTML = "Remove Tag";

        tag.appendChild(textInput);
        tag.appendChild(br);
        tag.appendChild(suggestDiv);
        tag.appendChild(br);
        tag.appendChild(removeButton);
        tag.appendChild(br);

        return tag;


    }

    function createIngredientInputGroup(i, value1, value2, value3, value4)
    {

        var ingredient = createElement("div");

        var nameInput = createElement("input", "ingredientName" + i, null, "input", function () {
            suggestIngredient(i);
        });
        nameInput.setAttribute("type", "text");
        nameInput.setAttribute("placeholder", "Enter new Ingredient " + i + "...");


        if (value1 != null)
        {
            nameInput.value = value1;
        }


        var suggestDiv = createElement("div", "suggest" + i);


        var amountInput = createElement("input", "ingredientAmount" + i, "amount");
        amountInput.setAttribute("type", "number");
        amountInput.setAttribute("placeholder", "Enter amount...");
        amountInput.setAttribute("min", "1");

        if (value2 != null)
        {
            amountInput.value = value2;
        }

        var unitInput = createElement("select", "ingredientUnit" + i);
        var g = createElement("option");
        g.setAttribute("value", "g");
        g.innerHTML = "g";

        var lb = createElement("option");
        lb.innerHTML = "lb";
        lb.setAttribute("value", "lb");
        var ml = createElement("option");
        ml.innerHTML = "ml";
        ml.setAttribute("value", "ml");
        var oz = createElement("option");
        oz.innerHTML = "oz";
        oz.setAttribute("value", "oz");

        var g = createElement("option");
        g.setAttribute("value", "g");
        g.innerHTML = "g";

        var tsp = createElement("option");
        tsp.setAttribute("value", "teaspoon");
        tsp.innerHTML = "teaspoon";

        var kg = createElement("option");
        kg.setAttribute("value", "kg");
        kg.innerHTML = "kg";

        var l = createElement("option");
        l.setAttribute("value", "l");
        l.innerHTML = "l";

        var slice = createElement("option");
        slice.setAttribute("value", "slice");
        slice.innerHTML = "Slice";
        
        

        var tbs = createElement("option");
        tbs.setAttribute("value", "tbs");
        tbs.innerHTML = "Table Spoon";
        unitInput.appendChild(tbs);
        
        //sample for adding more unit type
        var none = createElement("option");
        none.setAttribute("value", "(none)");
        none.innerHTML = "(none)";
        unitInput.appendChild(none);
        
        


        unitInput.appendChild(g);
        unitInput.appendChild(kg);
        unitInput.appendChild(lb);
        unitInput.appendChild(oz);
        unitInput.appendChild(ml);
        unitInput.appendChild(l);

        unitInput.appendChild(slice);
        unitInput.appendChild(tsp);






        if (value3 != null)
        {
            unitInput.value = value3;
        }
        var modInput = createElement("input", "ingredientMod" + i);
        modInput.setAttribute("type", "text");
        modInput.setAttribute("placeholder", "Modifiers(Chopped?Diced?Blended?)");

        if (value4 != null)
        {
            modInput.value = value4;
        }

        var removeButton = createElement("button", '', null, "click", function () {
            removeIngredient(i);
        });
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

    function createElement(type, id, className, event, func)
    {
        var obj = document.createElement(type);
        if (id != null)
        {
            obj.id = id;
        }

        if (className != null)
        {
            obj.className = className;
        }

        if (event != null && func != null)
        {
            obj.addEventListener(event, func);
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

                    doms.push(createIngredientInputGroup(i, ingredientName, ingredientAmount, ingredientUnit, ingredientMod));



                } else if (removed)
                {
                    doms.push(createIngredientInputGroup(i - 1, ingredientName, ingredientAmount, ingredientUnit, ingredientMod));

                }
            }
            ingredientTab--;
            ingredientSpace.innerHTML = "";

            for (var i = 0; i < doms.length; i++)
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

                var value = document.getElementById("step" + i).value;

                var img = document.getElementById("stepImagePreview" + i).src;




                if (index == i)
                {

                    removed = true;

                } else if (!removed)
                {
                    doms.push(createStepInputGroup(i, value, img));
                } else if (removed)
                {
                    doms.push(createStepInputGroup(i - 1, value, img));
                }
            }
            stepTab--;
            stepSpace.innerHTML = "";

            for (var i = 0; i < doms.length; i++)
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
                var value = document.getElementById("tag" + i).value;
                if (index == i)
                {
                    removed = true;
                } else if (!removed)
                {
                    doms.push(createTagInputGroup(i, value));
                } else if (removed)
                {
                    doms.push(createTagInputGroup(i - 1, value));
                }
            }
            tagTab--;
            tagSpace.innerHTML = "";
            for (var i = 0; i < doms.length; i++)
            {
                tagSpace.appendChild(doms[i]);
            }
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

                    user_id = this.responseText;
                    submitData();

                } else
                {
                    alert("Please login to perform this action");
                }
            }
        };
        xmlhttp.open("GET", "../user/checkLoginStatus.php", true);
        xmlhttp.send();
    }

    function submitData()
    {

        tagAjax = [];
        stepAjax = [];
        ingredientAjax = [];


        if (checkDuplicateName())
        {
            alert("Duplicate name, please try again");
            return;
        }

        var time = document.getElementById("recipeTime").value;
        var recipeName = document.getElementById("recipeName").value;
        var recipeDesc = document.getElementById("recipeDesc").value;
        var recipeServing = document.getElementById("recipeServing").value;
        var difficulty = document.getElementById("difficulty").value;
        var youtube = document.getElementById("youtube").value;

        if (recipeName === "" || recipeDesc === "" || recipeServing === "")
        {
            //document.getElementById("recipeName").scrollIntoView();
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
                //document.getElementById("ingredientName"+i).scrollIntoView();
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





            ingredientAjax.push("name=" + ingredientName + "&amount=" + ingredientAmount + "&unit=" + ingredientUnit + "&mod=" + ingredientMod);

        }






        for (var i = 1; i <= tagTab; i++)
        {
            var tag = "tag=" + document.getElementById("tag" + i).value;
            if (tag === "")
            {
                //document.getElementById("tag"+i).scrollIntoView();
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

        checkPreviewImage();
    }


    function setIngredient(id, name)
    {

        document.getElementById(id).value = name;
    }

    function setTag(id, name)
    {
        document.getElementById(id).value = name;
    }

    function checkFile(input)
    {
        var imgSrc = window.URL;

        var file = input.files[0];

        if (file)
        {

            var idText = input.id;

            var idNum = idText.charAt(idText.length - 1);

            var preview = document.getElementById("stepImagePreview" + idNum);

            preview.style.height = "200px";

            var image = new Image();

            image.onload = function () {
                if (this.height && this.width)
                {
                    preview.src = image.src;
                } else
                {
                    console.log("invalid input");
                }
            };

            image.src = URL.createObjectURL(file);
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

            image.onload = function () {
                if (this.height && this.width)
                {
                    preview.src = image.src;
                } else
                {
                    console.log("invalid input");
                }
            };

            image.src = URL.createObjectURL(file);
        }
    }







</script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/submit_recipe.css">
<div class="container">

    <div class="row">

        <div class="col-lg-8 wow" id="submit8">
            
             <h1 style="font-family: 'Courgette', cursive; color: #6666ff;">Upload a Recipe to UniMeals</h1>
             <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Submit an image for the recipe</h5>
                <img id="previewImageMain">
                <input type="file" name="image_file" id="image_file" onchange="loadPreview(this)">
            </div>
            <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Enter Recipe Name:</h5>
                <input type="text" placeholder="" id="recipeName" onchange="checkDuplicateName()">
                <p id="nameWarning"></p>
            </div>
            <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Recommended Servings:</h5>
                <input  type="number" placeholder="1, 2, 3" id="recipeServing" min="1">
            </div>
            <br>

            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Enter ingredient(s):</h5>
                <div id="ingredientSpace"></div>
                <br>
                <button type="button" onclick="addIngredientTab()" class="btn btn-primary">Add new Ingredient</button>

            </div>
         
            
           

            <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Enter Recipe Description:</h5>
                <textarea type="text" placeholder="..." id="recipeDesc"></textarea>
            </div>
            <br>

            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Difficulty:</h5>
                <select id="difficulty">
                    <option value="Easy">College Student(Easy)</option>
                    <option value="Medium">Chef(Medium)</option>
                    <option value="Hard">Michelin Chef(Hard)</option>
                </select>
            </div>
            <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Cooking time:</h5>
                <input type="number" placeholder="(Minutes)" id="recipeTime" min="1">
            </div>
            <br>


            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Enter a step(s):</h5>
                <div id="stepSpace"></div>

                <br>
                <button type="button" onclick="addStepTab()" class="btn btn-primary">Add Step</button>
            </div>

            <br>
            <div class="part">
                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Enter a tag(s):</h5>
                <div id="tagSpace"></div>
                <br>
                <button type="button" onclick="addTagTab()" class="btn btn-primary">Add Tag</button>
            </div>
            <br>

            <div class="part tagz" >

                <h5 style="font-family: 'Courgette', cursive; color: #6666ff;">Exclude(s):</h5>


                <p style="color:red; font-size: 1em;"><u>Attention:</u> Please check the following check boxes to warn users of allergen risks, recipes without correct allergen warning is a threat to other user's health and safety and therefore any recipe without correct allergen warning will be taken down by the Admin.</p>

                <input type="checkbox"  value="no_wheat" class="noTag">&nbsp;&nbsp;Wheat<br>
                <input type="checkbox" value="no_crustacean" class="noTag">&nbsp;&nbsp;Crustaceans<br>
                <input type="checkbox" value="no_egg" class="noTag">&nbsp;&nbsp;Egg<br>
                <input type="checkbox" value="no_fish" class="noTag">&nbsp;&nbsp;Fish<br>
                <input type="checkbox" value="no_peanut" class="noTag">&nbsp;&nbsp;Peanuts<br>
                <input type="checkbox" value="no_soy" class="noTag">&nbsp;&nbsp;Soy<br>
                <input type="checkbox" value="no_milk" class="noTag">&nbsp;&nbsp;Milk<br>
                <input type="checkbox" value="no_nuts" class="noTag">&nbsp;&nbsp;Nuts<br>
                <input type="checkbox" value="no_celery" class="noTag">&nbsp;&nbsp;Celery<br>
                <input type="checkbox" value="no_mustard" class="noTag">&nbsp;&nbsp;Mustard<br>
                <input type="checkbox" value="no_sesame" class="noTag">&nbsp;&nbsp;Sesame<br>
                <input type="checkbox" value="no_shellfish" class="noTag">&nbsp;&nbsp;Shellfish<br>
            </div>
            <br><br>
            <div class="part">
                <img src="../images/yt.png" height="100px" width="100px"/>
                <p><b><u>Optional:</u></b> Provide a YouTube tutorial video</p>
                <input type="text" id="youtube" placeholder="Paste link here...">
            </div>
            <br><br>

            <button type="button" onclick="checkLoginStatus()" class="btn btn-success">Submit Recipe</button>
        </div> 


    </div>
</div>
</div>

<?php
include 'footer.php';
?>



</body>
</html>
