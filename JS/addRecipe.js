/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var ingredientTab = 1;
var stepTab = 1;
var tagTab = 1;

var ingredientAjax = [];
var stepAjax = [];
var tagAjax = [];
var user_id;



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

        xmlhttp.open("GET", "../recipe/suggest_ingredient.php?name=" + name, true);
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
        ajaxRecipeTagRequest(tagAjax[i] + "&recipe_id=" + recipeID);
    }
}

function ajaxRecipeRequest()
{
    var time = document.getElementById("recipeTime").value;
    var recipeName = document.getElementById("recipeName").value;
    var recipeDesc = document.getElementById("recipeDesc").value;
    var recipeServing = document.getElementById("recipeServing").value;
    var difficulty = document.getElementById("difficulty").value;

    var formData = new FormData();

    var imageFileInput = document.getElementById('image_file');
    if (imageFileInput.value.length > 0)
    {
        var image_file = imageFileInput.files[0];

        formData.append('image_file', image_file, "recipe_image");
    }
    formData.append('time', time);
    formData.append('name', recipeName);
    formData.append('desc', recipeDesc);
    formData.append('serving', recipeServing);
    formData.append('difficulty', difficulty);
    formData.append('id', user_id);







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

function ajaxRecipeStepRequest(id)
{

    alert("running with " + id);
    alert(stepTab);

    for (var i = 1; i < stepTab + 1; i++)
    {


        var formData = new FormData();

        var step = document.getElementById("step" + i).value;

        formData.append("step", step);
        formData.append("recipe_id", id);

        var stepImageInput = document.getElementById("stepImage" + i);
        if (stepImageInput.value.length > 0)
        {
            var stepImageFile = stepImageInput.files[0];

            formData.append('step_image', stepImageFile, "step_image");
        } else
        {

        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(this.responseText);
            }
        };
        xmlhttp.open("POST", "../recipe/create_recipe_step.php", true);
        xmlhttp.send(formData);
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

function initTab()
{
    document.getElementById("ingredientSpace").innerHTML = "<input type='text' placeholder='Ingredient 1' id='ingredientName1' oninput='suggestIngredient(1)'><div id='suggest1'></div>\n\
                                                                <input type='number' placeholder='Amount' id='ingredientAmount1'>\n\
                                                                <input type='text' placeholder='In what unit?' id='ingredientUnit1'>\n\
                                                                <input type='text' placeholder='Chop?Diced?Blended?' id='ingredientMod1'>\n\
                                                                <input type='checkbox' id='vegan1'><button onclick='removeIngredient(1)'>Remove</button><br>";
    document.getElementById("stepSpace").innerHTML = "<input type='text' placeholder='Step 1...' id='step1'><br>Upload an image for step 1:<input type='file' id='stepImage1'><br><button onclick='removeStep(1)'>Remove</button><br>";
    document.getElementById("tagSpace").innerHTML = "<input type='text' placeholder='Enter a tag...' id='tag1'><button onclick='removeTag(1)'>Remove</button><br>";
}

function addTagTab()
{
    var existingTabs = "";

    for (var i = 1; i <= tagTab; i++)
    {
        var tagName = document.getElementById("tag" + i).value;

        existingTabs += "<input type='text' value='" + tagName + "' placeholder='Enter a tag...' id='tag" + i + "'>";

        existingTabs += "<button onclick='removeTag(" + i + ")'>Remove</button><br>";

    }

    tagTab++;

    existingTabs += "<input type='text' placeholder='Enter a tag...' id='tag" + tagTab + "'><button onclick='removeTag(" + tagTab + ")'>Remove</button><br>";

    document.getElementById("tagSpace").innerHTML = existingTabs;
}

function addIngredientTab()
{

    var existingTabs = "";

    for (var i = 1; i <= ingredientTab; i++)
    {
        var ingredientName = document.getElementById("ingredientName" + i).value;
        var ingredientAmount = document.getElementById("ingredientAmount" + i).value;
        var ingredientUnit = document.getElementById("ingredientUnit" + i).value;
        var ingredientMod = document.getElementById("ingredientMod" + i).value;



        existingTabs += "<input type='text' placeholder='Ingredient " + i + "' id='ingredientName" + i + "' value='" + ingredientName + "' oninput='suggestIngredient(" + i + ")'><div id='suggest" + i + "'></div>\n\
                       <input type='number' placeholder='Amount' id='ingredientAmount" + i + "' value='" + ingredientAmount + "'>\n\
                       <input type='text' placeholder='In what unit?' id='ingredientUnit" + i + "' value='" + ingredientUnit + "'>\n\
                       <input type='text' placeholder='Chop?Diced?Blended?' id='ingredientMod" + i + "' value='" + ingredientMod + "'>";
        if (document.getElementById("vegan" + i).checked)
        {
            existingTabs += "<input type='checkbox' id='vegan" + i + "' checked>";
        } else
        {
            existingTabs += "<input type='checkbox' id='vegan" + i + "'>";
        }
        existingTabs += "<button onclick='removeIngredient(" + i + ")'>Remove</button><br>"

    }

    ingredientTab++;

    existingTabs += "<input type='text' placeholder='Ingredient " + ingredientTab + "' id='ingredientName" + ingredientTab + "' oninput='suggestIngredient(" + ingredientTab + ")'><div id='suggest" + ingredientTab + "'></div>\n\
                       <input type='number' placeholder='Amount' id='ingredientAmount" + ingredientTab + "'>\n\
                       <input type='text' placeholder='In what unit?' id='ingredientUnit" + ingredientTab + "'>\n\
                       <input type='text' placeholder='Chop?Diced?Blended?' id='ingredientMod" + ingredientTab + "'>\n\
                       <input type='checkbox' id='vegan" + ingredientTab + "'><button onclick='removeIngredient(" + ingredientTab + ")'>Remove</button><br>";

    document.getElementById("ingredientSpace").innerHTML = existingTabs;


}

function removeIngredient(index)
{
    if (ingredientTab > 1)
    {
        var existingTabs = "";

        var removed = false;

        for (var i = 1; i <= ingredientTab; i++)
        {
            if (i == index)
            {
                removed = true;
            } else if (!removed)
            {
                var ingredientName = document.getElementById("ingredientName" + i).value;
                var ingredientAmount = document.getElementById("ingredientAmount" + i).value;
                var ingredientUnit = document.getElementById("ingredientUnit" + i).value;
                var ingredientMod = document.getElementById("ingredientMod" + i).value;



                existingTabs += "<input type='text' placeholder='Ingredient " + i + "' id='ingredientName" + i + "' value='" + ingredientName + "' oninput='suggestIngredient(" + i + ")'><div id='suggest" + i + "'></div>\n\
                               <input type='number' placeholder='Amount' id='ingredientAmount" + i + "' value='" + ingredientAmount + "'>\n\
                               <input type='text' placeholder='In what unit?' id='ingredientUnit" + i + "' value='" + ingredientUnit + "'>\n\
                               <input type='text' placeholder='Chop?Diced?Blended?' id='ingredientMod" + i + "' value='" + ingredientMod + "'>";
                if (document.getElementById("vegan" + i).checked)
                {
                    existingTabs += "<input type='checkbox' id='vegan" + i + "' checked>";
                } else
                {
                    existingTabs += "<input type='checkbox' id='vegan" + i + "'>";
                }

                existingTabs += "<button onclick='removeIngredient(" + i + ")'>Remove</button>"

            } else if (removed)
            {
                var ingredientName = document.getElementById("ingredientName" + i).value;
                var ingredientAmount = document.getElementById("ingredientAmount" + i).value;
                var ingredientUnit = document.getElementById("ingredientUnit" + i).value;
                var ingredientMod = document.getElementById("ingredientMod" + i).value;



                existingTabs += "<input type='text' placeholder='Ingredient " + (i - 1) + "' id='ingredientName" + (i - 1) + "' value='" + ingredientName + "' oninput='suggestIngredient(" + (i - 1) + ")'><div id='suggest" + (i - 1) + "'></div>\n\
                               <input type='number' placeholder='Amount' id='ingredientAmount" + (i - 1) + "' value='" + ingredientAmount + "'>\n\
                               <input type='text' placeholder='In what unit?' id='ingredientUnit" + (i - 1) + "' value='" + ingredientUnit + "'>\n\
                               <input type='text' placeholder='Chop?Diced?Blended?' id='ingredientMod" + (i - 1) + "' value='" + ingredientMod + "'>";
                if (document.getElementById("vegan" + i).checked)
                {
                    existingTabs += "<input type='checkbox' id='vegan" + (i - 1) + "' checked>";
                } else
                {
                    existingTabs += "<input type='checkbox' id='vegan" + (i - 1) + "'>";
                }

                existingTabs += "<button onclick='removeIngredient(" + (i - 1) + ")'>Remove</button>"

            }

        }

        ingredientTab--;



        document.getElementById("ingredientSpace").innerHTML = existingTabs;
    }
}

function addStepTab()
{
    var existingSteps = "";//= "<b>TEAST</b>";

    //                for(var i=1;i<=stepTab;i++)
    //                {
    //                    var step = document.getElementById("step"+i).value;
    //                   
    //                    existingSteps += "<input type='text' placeholder='Step "+i+"...' id='step"+i+"' value='"+step+"'><br>Upload an image for step "+i+":<input type='file' id='stepImage"+i+"'><br><button onclick='removeStep("+i+")'>Remove</button><br>";
    //                    
    //                }


    stepTab++;
    alert(stepTab);
    existingSteps += "<input type='text' placeholder='Step " + stepTab + "...' id='step" + stepTab + "'><br>Upload an image for step " + stepTab + ":<input type='file' id='stepImage" + stepTab + "'><br><button onclick='removeStep(" + stepTab + ")'>Remove</button><br>";

    document.getElementById("stepSpace").innerHTML = existingSteps;


}

function removeStep(index)
{
    if (stepTab > 1)
    {
        var existingSteps = "";
        var removed = false;

        for (var i = 1; i <= stepTab; i++)
        {
            if (index == i)
            {
                removed = true;
            } else if (!removed)
            {
                var step = document.getElementById("step" + i).value;

                existingSteps += "<input type='text' placeholder='Step " + i + "...' id='step" + i + "' value='" + step + "'><br>Upload an image for step " + i + ":<input type='file' id='stepImage" + i + "'><br><button onclick='removeStep(" + i + ")'>Remove</button><br>";

            } else if (removed)
            {
                var step = document.getElementById("step" + (i)).value;

                existingSteps += "<input type='text' placeholder='Step " + (i - 1) + "...' id='step" + (i - 1) + "' value='" + step + "'><br>Upload an image for step " + (i - 1) + ":<input type='file' id='stepImage" + (i - 1) + "'><br><button onclick='removeStep(" + (i - 1) + ")'>Remove</button><br>";
            }
        }


        stepTab--;


        document.getElementById("stepSpace").innerHTML = existingSteps;
    }
}

function removeTag(index)
{
    if (tagTab > 1)
    {
        var existingTags = "";
        var removed = false;

        for (var i = 1; i <= tagTab; i++)
        {
            if (index == i)
            {
                removed = true;
            } else if (!removed)
            {
                var tag = document.getElementById("tag" + i).value;
                existingTags += "<input type='text' placeholder='Enter a Tag...' id='tag" + i + "' value='" + tag + "'><button onclick='removeTag(" + i + ")'>Remove</button><br>";

            } else if (removed)
            {
                var tag = document.getElementById("tag" + (i)).value;
                existingTags += "<input type='text' placeholder='Enter a Tag' id='tag" + (i - 1) + "' value='" + tag + "'><button onclick='removeTag(" + (i - 1) + ")'>Remove</button><br>";
            }
        }


        tagTab--;


        document.getElementById("tagSpace").innerHTML = existingTags;
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

        var vegan;

        if (document.getElementById("vegan" + i).checked)
        {
            vegan = "1";
        } else
        {
            vegan = "0";
        }



        ingredientAjax.push("name=" + ingredientName + "&amount=" + ingredientAmount + "&unit=" + ingredientUnit + "&mod=" + ingredientMod + "&vegan=" + vegan);

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


