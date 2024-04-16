<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$unit_price = $_POST['unit_price'];
$unit_quantity = $_POST['unit_quantity'];
$in_stock = $_POST['in_stock'];
$cat_id = $_POST['cat_id'];
$cat_sub_id = $_POST['cat_sub_id'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$sql = "INSERT INTO products (product_name, unit_price, unit_quantity, in_stock, cat_id, cat_sub_id, image) 
        VALUES ('$product_name', '$unit_price', '$unit_quantity', '$in_stock', '$cat_id', '$cat_sub_id', '$target_file')";

if ($conn->query($sql) === TRUE) {
    header("Location: product.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
