

function searchRecipe()
{
    var term = document.getElementById("term").value;

    var sort = document.getElementById("sort").value;

    var order = document.getElementById("order").value;

    var tags = document.getElementsByClassName("tag");

    var noTags = document.getElementsByClassName("noTag");


    var noTagString = "";

    var tagString = "";

    var first = true;

    var checked = false;

    for (var i = 0; i < tags.length; i++)
    {
        if (tags[i].checked)
        {
            if (first)
            {
                tagString += tags[i].value;
                first = false;
            } else
            {
                tagString += "%%" + tags[i].value;
            }
            checked = true;
        }
    }

    if (!checked)
    {
        tagString = "null";
    }

    checked = false;

    first = true;


    for (var i = 0; i < noTags.length; i++)
    {
        if (noTags[i].checked)
        {
            if (first)
            {
                noTagString += noTags[i].value;
                first = false;
            } else
            {
                noTagString += "%%" + noTags[i].value;
            }
            checked = true;
        }
    }

    if (!checked)
    {
        noTagString = "null";
    }










    if (term.length == 0)
    {
        document.getElementById("result").innerHTML = "";

    } else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../recipe_login/search_recipe.php?term=" + term + "&sort=" + sort + "&order=" + order + "&tag=" + tagString + "&noTag=" + noTagString, true);
        xmlhttp.send();
    }
}







