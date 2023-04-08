<?php
 require 'connection.php';

$mysqli = 'SELECT  faculty_name FROM faculty';


$result = mysqli_query($con , $mysqli);

$faculty = mysqli_fetch_all($result , MYSQLI_ASSOC);

$response['faculty'] = $faculty;

echo json_encode($response);


?>