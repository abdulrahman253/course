<?php

require 'connection.php';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$fullname=$data['fullname'];
$email=$data['email'];
$password=md5($data['password']);
$university = $data['university'] ;
$faculty_id=$data['faculty_id'];
$image= $data['image'];



$checkUser="SELECT * from user WHERE email='$email'";
$checkQuery=mysqli_query($con,$checkUser);

if(mysqli_num_rows($checkQuery)>0){
    http_response_code(201);
    $user = mysqli_fetch_assoc($checkQuery);
    echo json_encode($user);
}
else
{
   $insertQuery="INSERT INTO user(fullname,email,Password,university,faculty_id,image) VALUES('$fullname','$email','$password','$university','$faculty_id','$image')";
   $result=mysqli_query($con, $insertQuery);
   if($result) {
    http_response_code(201);
    $userId = mysqli_insert_id($con);
    $selectQuery = "SELECT * FROM user WHERE student_id = '$userId'";
    $userResult = mysqli_query($con, $selectQuery);
    $user = mysqli_fetch_assoc($userResult);
    echo json_encode($user);
} else {    
    http_response_code(500);
    $response['message'] = "Failed to add the user";
    echo json_encode($response);

}
}


?>