<?php
require 'connection.php';

$product_name=$_POST['product_name'];
$product_image=$_POST['product_image'];
$product_desc=$_POST['product_desc'];
$student_id=$_POST['student_id'];
$category_id=$_POST['category_id'];
$price=$_POST['price'];

// Check if student exists
$checkStudent = "SELECT * FROM student WHERE student_id = '$student_id'";
$studentResult = mysqli_query($con, $checkStudent);

// Check if category exists
$checkCategory = "SELECT * FROM category WHERE category_id = '$category_id'";
$categoryResult = mysqli_query($con, $checkCategory);

// Check if both student and category exist
if(mysqli_num_rows($studentResult) > 0 && mysqli_num_rows($categoryResult) > 0) {
    $insertQuery="INSERT INTO product(product_name, product_image, product_desc, student_id, category_id, price) VALUES ('$product_name', '$product_image', '$product_desc', '$student_id', '$category_id', '$price')";
    $result=mysqli_query($con, $insertQuery);
    if($result) {
        $response['error'] = "0";
        $response['message'] = "Product added successfully";
    } else {
        $response['error'] = "500";
        $response['message'] = "Failed to add product";
    }
} else {
  $response['error'] = "400";
  $response['message'] = "Invalid student or category";
}

echo json_encode($response);
?>
