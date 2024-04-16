<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$cat_name = $_POST['cat_name'];

// SQL to insert data into category table
$sql = "INSERT INTO category (cat_name) VALUES ('$cat_name')";

if ($conn->query($sql) === TRUE) {
    header("Location: add_category.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Retrieve data from the category table
$sql = "SELECT cat_id, cat_name FROM category";
$result = $conn->query($sql);

// Close connection
$conn->close();
