<?php
require 'connection.php';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);


$service_name=$data['service_name'];
$service_type=$data['service_type'];
$subject_id=$data['subject_id'];
$student_id=$data['student_id'];
$attachment=$data['attachment'];
$in_favourite=$data['in_favourite'];


if($service_name ==null || $student_id==null){
    http_response_code(400);
    $response['message'] = "Some fields are missed";
    echo json_encode($response);
    return;
}

// Check if student exists
$checkStudent = "SELECT * FROM user WHERE student_id = '$student_id'";
$studentResult = mysqli_query($con, $checkStudent);

// Check if type exists
$checkCategory = "SELECT * FROM service_types WHERE id = '$service_type'";
$categoryResult = mysqli_query($con, $checkCategory);

// Check if both student and category exist
if(mysqli_num_rows($studentResult) > 0 ) {
    $insertQuery="INSERT INTO service(service_name, service_type, subject_id, student_id,attachment,in_favourite) VALUES ('$service_name', '$service_type', '$subject_id', '$student_id', '$attachment','$in_favourite')";
    $result=mysqli_query($con, $insertQuery);
    if($result) {
        http_response_code(201);
        $serviceId = mysqli_insert_id($con);
        $selectQuery = "SELECT * FROM service WHERE service_id = '$serviceId'";
        $serviceResult = mysqli_query($con, $selectQuery);
        $service = mysqli_fetch_assoc($serviceResult);
        echo json_encode($service);
        $response['message'] = "service added successfully";
        echo json_encode($response);
    } else {    
        http_response_code(500);
        $response['message'] = "Failed to add the service";

    }
} else {
    http_response_code(400);
    $response['message'] = "Invalid student or service type";

echo json_encode($response);

}

?>