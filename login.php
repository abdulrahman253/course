<?php

  require 'connection.php';
  $json_data = file_get_contents("php://input");
  $data = json_decode($json_data, true);

  $email=$data['email'];
  $password=md5($data['password']);

  $checkUser="SELECT * FROM user WHERE email='$email'";

  $result=mysqli_query($con,$checkUser);

  if(mysqli_num_rows($result)>0){ 

    $checkUserquery="SELECT student_id, fullname, email FROM user WHERE email='$email' and password='$password'";
    $resultant=mysqli_query($con,$checkUserquery);

    if(mysqli_num_rows($resultant)>0){

      while($row=$resultant->fetch_assoc())
      
      $response['user']=$row;
      $response['message']="login success";
    }
    else{
      $response['user']=(object)[];
      $response['message']="Wrong credentials";

    }
   
    
  }
  else{

    $response['user']=(object)[];
    $response['error']="400";
  	$response['message']="user does not exist";


  }

  echo json_encode($response);
    
?>