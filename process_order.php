<?php
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

// Check if the total key exists in the $_POST array
if (isset($_POST['total'])) {
    // Get the form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $streetaddress = $_POST['streetaddress'];
    $apartment = $_POST['apartment'];
    $towncity = $_POST['towncity'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $total = $_POST['total']; // Retrieve the total from the form

    // Insert the order details into the database
    $sql = "INSERT INTO orders (firstname, lastname, country, streetaddress, apartment, towncity, postcode, phone, email, total) VALUES ('$firstname', '$lastname', '$country', '$streetaddress', '$apartment', '$towncity', '$postcode', '$phone', '$email', '$total')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to checkout.php
        header("Location: checkout.php");
        exit(); // Make sure no further output is sent
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Total not provided.";
}

// Close the database connection
$conn->close();
?>
