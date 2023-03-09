<?php
 require 'connection.php';

$mysqli = 'SELECT category_id , name FROM category';


$result = mysqli_query($con , $mysqli);

$category = mysqli_fetch_all($result , MYSQLI_ASSOC);



echo json_encode($category);


?>