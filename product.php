<?php
require 'connection.php';



$product_id=$_POST['product_id'];
$product_name=$_POST['product_name'];
$product_image=$_POST['product_image'];
$product_desc=$_POST['product_desc'];
$student_id=$_POST['student_id'];
$category_id=$_POST['category_id'];
$price=$_POST['price'];



$addproduct="SELECT * from product WHERE product_id='$product_id'";
$checkQuery=mysqli_query($con,$addproduct);

if(mysqli_num_rows($checkQuery)>0){

    $response['error']="400";
    $response['message']="product exist";
}
else
{
   $insertQuery="INSERT INTO product(product_id,product_name,product_image,product_desc,student_id,category_id,price) VALUES('$product_id','$product_name','$product_image','$product_desc','$student_id','$category_id',$price)";
$result=mysqli_query($con,$insertQuery);
}


echo json_encode($response);

?>



