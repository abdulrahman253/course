<?php

require 'connection.php';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$fullname=$data['fullname'];
$email=$data['email'];
$password=md5($data['password']);
$university = $data['university'] ;
$faculty=$data['faculty'];
//$image= $_POST['image'];

$checkUser="SELECT * from user WHERE email='$email'";
$checkQuery=mysqli_query($con,$checkUser);

if(mysqli_num_rows($checkQuery)>0){
     
    while($row=$checkQuery->fetch_assoc())
    $response['user']=$row;
    $response['message']="User exist";
}
else
{
   $insertQuery="INSERT INTO user(fullname,email,Password,university,faculty_id) VALUES('$fullname','$email','$password','$university','$faculty')";
   $result=mysqli_query($con,$insertQuery);

if($insertQuery){
    
    $response['message'] = "";
    $response['message']="Register successful!";
 }
else
{
    $response['error']="400";
    $response['message']="Registeration failed!";
}

}

echo json_encode($response);

?>