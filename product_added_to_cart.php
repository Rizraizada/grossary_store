<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Added to Cart</title>
    <!-- Add your CSS stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Product Added to Cart</h1>
        <?php
        // Check if the product addition was successful and product data is available
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['added_product'])) {
            $addedProduct = $_SESSION['added_product'];
            ?>
            <div>
                <h3>Product Details:</h3>
                <p><strong>ID:</strong> <?php echo $addedProduct['id']; ?></p>
                <p><strong>Name:</strong> <?php echo $addedProduct['name']; ?></p>
                <p><strong>Price:</strong> $<?php echo number_format($addedProduct['price'], 2); ?></p>
                <p><strong>Quantity:</strong> <?php echo $addedProduct['quantity']; ?></p>
                <!-- You can add more product details here if needed -->
            </div>
            <?php
            // Unset the added product session variable to avoid displaying it again on page refresh
            unset($_SESSION['added_product']);
        } else {
            // If the product addition was not successful or product data is not available
            echo "<p>No product added to the cart.</p>";
        }
        ?>
        <a href="cart.php">View Cart</a> <!-- Link to the cart page -->
    </div>
</body>
</html>
