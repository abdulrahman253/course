<?php
 require 'connection.php';

$category = $_GET['category'];

$sql = 'SELECT s.fullname, s.image, p.product_id, p.product_name, p.product_image, p.product_desc, p.price, c.category_name
        FROM product p
        JOIN category c 
        ON p.category_id = c.category_id
        JOIN user s ON 
        p.student_id = s.student_id
        WHERE c.category_name = ?';

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $products = array();
    while ($product = $result->fetch_assoc()) {
        $products[] = array(
            'fullname' => $product['fullname'],
            'image'=> $product['image'],
            'product_name' => $product['product_name'],
            'product_image' => $product['product_image'],
            'product_desc' => $product['product_desc'],
            'price' => $product['price']
        );
    }
    $response = array(
        'products' => $products,
        'success' => true,
        'message' => 'products found'
    );
    echo json_encode($response);
} else {
    // No results found
    $response = array(
        'success' => false,
        'message' => 'No products found'
    );
    echo json_encode($response);
}


?>
