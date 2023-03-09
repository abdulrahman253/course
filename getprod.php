<?php
 require 'connection.php';

//  List supported query params
// Univeristy, student_id, category, faculty_id,



$mysqli = 'SELECT p .*, c.name as category_name from product p
INNER join category c
on p.category_id = c.category_id';


$result = mysqli_query($con , $mysqli);

$category = mysqli_fetch_all($result , MYSQLI_ASSOC);


echo json_encode($category);


?>