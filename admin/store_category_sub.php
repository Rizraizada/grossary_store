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
$cat_id = $_POST['cat_id'];
$cat_sub_name = $_POST['cat_sub_name'];

// SQL to insert data into category_sub table
$sql = "INSERT INTO category_sub (cat_id, cat_sub_name) VALUES ('$cat_id', '$cat_sub_name')";

if ($conn->query($sql) === TRUE) {
    echo "Category sub added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
