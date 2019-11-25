<?php

include "../model/db_connect.php";

require "recipe_db.php";

$term = $_REQUEST['term'];
$sort = $_REQUEST['sort'];
$order = $_REQUEST['order'];

$tag = $_REQUEST['tag'];
$noTag = $_REQUEST['noTag'];

$result = searchRecipe($term, $sort, $order);




$response = "";

?>

<div class="sorting" id="sortNav">
                Sort by 
                <select id="sort">
                    <option value="recipe_name">Name</option>
                    <option value="time">Submitted Date</option>
                    <option value="rating">User Rating</option>
                    <option value="cooking_time">Cooking Time</option>

                </select>
                order by
                <select id="order">
                    <option value="asc">Ascending Order</option>
                    <option value="desc">Descending Order</option>
                </select>
            </div>
<?php

foreach ($result as $res) {

    if (filterResults($tag, $noTag, $res["recipe_id"])) {
//            $response = $response . "<p><h2><a href='?action=view_recipe&id=" . $res['recipe_id'] . "'>" . $res['recipe_name'] . "</h2></a></p><p>" . $res['description'] . "</p>";
        $response = $response . printRecipe($res);
    }
}


echo $response;
?>