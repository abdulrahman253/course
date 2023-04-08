<?php
 require 'connection.php';

$mysqli = 'SELECT  university_name FROM University';


$result = mysqli_query($con , $mysqli);

$university = mysqli_fetch_all($result , MYSQLI_ASSOC);

$response['university'] = $university;

echo json_encode($response);


?>