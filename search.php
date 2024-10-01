<?php
// Include the Database and Product classes
require_once('structure.php');

// Instantiate Database class 
$database = new Database();
$conn = $database->getConnection();

// Instantiate Product class 
$product = new Product($conn);

// Handle search request
if (isset($_GET['search'])) {
    // Retrieve search query
    $searchQuery = $_GET['search'];
    
    // Perform search query
    $searchResults = $product->searchProducts($searchQuery);
}
?>
 