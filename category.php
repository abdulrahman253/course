<?php
 require 'connection.php';

$mysqli = 'SELECT category_id , category_name FROM category';


$result = mysqli_query($con , $mysqli);

$category = mysqli_fetch_all($result , MYSQLI_ASSOC);

$response ['category'] = $category;

echo json_encode($response);


?>