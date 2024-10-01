<?php
session_start();

// Check if session cart array is initialized, if not initialize it
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_POST['id'])) {
    echo json_encode(array('success' => false, 'message' => 'Product ID is not provided.'));
    exit;
}

$productId = intval($_POST['id']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'message' => 'Failed to connect to the database.'));
    exit;
}

$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $productData = array(
        'id' => $row['product_id'],
        'name' => $row['product_name'],
        'price' => $row['unit_price'],
 
        'quantity' => 1
    );

    $_SESSION['cart'][] = $productData;

    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'message' => 'Failed to retrieve product data.'));
}

$stmt->close();
$conn->close();
?>
