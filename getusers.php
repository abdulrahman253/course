<?php
 require 'connection.php';

$mysqli = 'SELECT * FROM user';


$result = mysqli_query($con , $mysqli);

$users = mysqli_fetch_all($result , MYSQLI_ASSOC);



echo json_encode($users);


?>