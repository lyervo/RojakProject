<?php

include "../model/db_connect.php";

require "recipe_db.php";

$term = $_REQUEST['term'];
$sort = $_REQUEST['sort'];
$order = $_REQUEST['order'];

$tag = $_REQUEST['tag'];
$noTag = $_REQUEST['noTag'];

$result = searchRecipe($term, $sort, $order);


$tag = strtolower($tag);
$noTag = strtolower($noTag);


$response = "";

?>


<?php

foreach ($result as $res) {

    if (filterResults($tag, $noTag, $res["recipe_id"])) {
//            $response = $response . "<p><h2><a href='?action=view_recipe&id=" . $res['recipe_id'] . "'>" . $res['recipe_name'] . "</h2></a></p><p>" . $res['description'] . "</p>";
        $response = $response . printRecipe($res);
    }
}


echo $response;
?>