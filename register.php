<?php

require 'connection.php';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$fullname=$data['fullname'];
$email=$data['email'];
$password=md5($data['password']);
$university_id = $data['university_id'] ;
$faculty_id=$data['faculty_id'];
$image= $data['image'];



$checkUser="SELECT * from user WHERE email='$email'";
$checkQuery=mysqli_query($con,$checkUser);

if(mysqli_num_rows($checkQuery)>0){


    while($row=$checkQuery->fetch_assoc())
    $response['user'] = $row;
    $response['message'] = "user exist";
    echo json_encode($response);
    
}


else
{
   $insertQuery="INSERT INTO user(fullname,email,Password,university_id,faculty_id,image) VALUES('$fullname','$email','$password','$university_id','$faculty_id','$image')";
   $result=mysqli_query($con, $insertQuery);
   if($result) {
    $userId = mysqli_insert_id($con);
    $selectQuery = "SELECT s.fullname , s.email , s.image , u.university_name , f.faculty_name
    FROM user s 
    JOIN University u
    ON s.university_id = u.id
    JOIN faculty f ON
    s.faculty_id = f.id
    WHERE s.student_id = '$userId'";
    
    $userResult = mysqli_query($con, $selectQuery);
    
    $user = mysqli_fetch_assoc($userResult);
    $user['Password'] = '';
    $response['user'] = $user;
    $response['message'] = "Registered successfully";
    echo json_encode($response);
} else {    
    http_response_code(500);
    $response['message'] = "Failed to add the user";
    echo json_encode($response);

}
}


?>