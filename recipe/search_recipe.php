<?php

include "../model/db_connect.php";

require "recipe_db.php";

$term = filter_var($_GET['term'],FILTER_SANITIZE_STRING);
$sort = filter_var($_GET['sort'],FILTER_SANITIZE_STRING);
$order = filter_var($_GET['order'],FILTER_SANITIZE_STRING);

$tag = filter_var($_GET['tag'],FILTER_SANITIZE_STRING);
$noTag = filter_var($_GET['noTag'],FILTER_SANITIZE_STRING);

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