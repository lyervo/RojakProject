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
                
                for(var i=0;i<tags.length;i++)
                {
                    if(tags[i].checked)
                    {
                        if(first)
                        {
                            tagString += tags[i].value;
                            first = false;
                        }else
                        {
                            tagString += "%%"+tags[i].value;
                        }
                        checked = true;
                    }
                }
                
                if(!checked)
                {
                    tagString = "null";
                }
                
                checked = false;
                
                first = true;
                
                
                for(var i=0;i<noTags.length;i++)
                {
                    if(noTags[i].checked)
                    {
                        if(first)
                        {
                            noTagString += noTags[i].value;
                            first = false;
                        }else
                        {
                            noTagString += "%%"+noTags[i].value;
                        }
                        checked = true;
                    }
                }
                
                if(!checked)
                {
                    noTagString = "null";
                }
                
                
                
                

                
                
                
                
                
                if (term.length == 0) 
                {
                    document.getElementById("result").innerHTML = "";
                   
                }else
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("result").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../recipe/search_recipe.php?term=" + term + "&sort=" + sort + "&order="+order +"&tag="+tagString+"&noTag="+noTagString, true);
                    xmlhttp.send();
                }
            }
            

            function collapsible(){
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
            }
            
function checkTag(tagName)
{
   
    let tags = document.getElementsByClassName('tag');
    let noTags = document.getElementsByClassName('noTag');
    
    for(let i = 0; i < tags.length; i++)
    {
        if(tags[i].value == tagName)
        {
            tags[i].checked = !tags[i].checked;
            if(tags[i].checked)
            {
                tags[i].parentElement.style.backgroundColor = "#005aba";
                tags[i].parentElement.style.color = "white";
                tags[i].parentElement.style.border = "1px solid #005aba";
            }else
            {
                
                tags[i].parentElement.style.backgroundColor = "white";
                tags[i].parentElement.style.color = "black";
                tags[i].parentElement.style.border = "1px solid #007bff";
                
                
                
            }
        }
        
    }
    
        for(let i = 0; i < noTags.length; i++)
        {
            if(noTags[i].value == tagName)
            {
                noTags[i].checked = !noTags[i].checked;

            }

        }
    
    
}

function hoverIn(x)
{
    if(x.children[0].checked)
    {
        
    }else
    {
        x.style.backgroundColor = "#007bff";
    }
}
function hoverOut(x)
{
    if(x.children[0].checked)
    {
        
    }else
    {
        x.style.backgroundColor = "#ffffff";
    }
}

function changeColourOnHover()
{
    let arr = document.getElementsByClassName("filterButton");
    for(let i = 0; i < arr.length; i++)
    {
        arr[i].addEventListener("mouseover", function()
        {
           hoverIn(arr[i]); 
        },false);
        
        arr[i].addEventListener("mouseout", function()
        {
           hoverOut(arr[i]); 
        },false);
        
    }
    
}