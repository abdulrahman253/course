<?php
require 'connection.php';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$product_name=$data['product_name'];
$product_image=$data['product_image'];
$product_desc=$data['product_desc'];
$student_id=$data['student_id'];
$category_id=$data['category_id'];
$price=$data['price'];

if($product_name ==null || $student_id==null){
    http_response_code(400);
    $response['message'] = "Some fields are missed";
    return;
}

// Check if student exists
$checkStudent = "SELECT * FROM user WHERE student_id = '$student_id'";
$studentResult = mysqli_query($con, $checkStudent);

// Check if category exists
$checkCategory = "SELECT * FROM category WHERE category_id = '$category_id'";
$categoryResult = mysqli_query($con, $checkCategory);

// Check if both student and category exist
if(mysqli_num_rows($studentResult) > 0 && mysqli_num_rows($categoryResult) > 0) {
    $insertQuery="INSERT INTO product(product_name, product_image, product_desc, student_id, category_id, price) VALUES ('$product_name', '$product_image', '$product_desc', '$student_id', '$category_id', '$price')";
    $result=mysqli_query($con, $insertQuery);
    if($result) {
        http_response_code(201);
        $productId = mysqli_insert_id($con);
        $selectQuery = "SELECT * FROM product WHERE product_id = '$productId'";
        $productResult = mysqli_query($con, $selectQuery);
        $product = mysqli_fetch_assoc($productResult);
        http_response_code(201);
        echo json_encode($product);
    } else {    
        http_response_code(500);
        $response['message'] = "Failed to add the product";
    }
} else {
    http_response_code(400);
    $response['message'] = "Invalid student or category";

echo json_encode($response);

}

?>