<?php

require 'connection.php';
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$university=$_POST['university'];
$faculty=$_POST['faculty'];
$image=$_POST['image'];



$checkUser="SELECT * from user WHERE email='$email'";
$checkQuery=mysqli_query($con,$checkUser);

if(mysqli_num_rows($checkQuery)>0){

     $response['error']="403";
    $response['message']="User exist";
}
else
{
   $insertQuery="INSERT INTO user(fullname,email,password,university,faculty,image) VALUES('$fullname','$email','$password','$university','$faculty','$image')";
$result=mysqli_query($con,$insertQuery);

if($insertQuery){

    $response['error']="200";
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