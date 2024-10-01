<!DOCTYPE html>
<html lang="en">

<head>
	<title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here">

	<?php
	// Start the session at the very beginning
	session_start();
	?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">Vegefoods</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<?php include 'structure.php'; ?>
						</div>
					</li>

					<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
					<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
					<li class="nav-item"><a href="register.html" class="nav-link">Register</a></li>
					<li class="nav-item"><a href="login.html" class="nav-link">Login</a></li>
					<li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
					<?php
					if (isset($_SESSION["username"])) {
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">' . $_SESSION["username"] . '</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<form action="logout.php" method="post">';
						echo '<button type="submit" class="btn btn-success ml-2" style="margin-top: 15px;">Logout</button>';
						echo '</form>';
						echo '</li>';
					} else {
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">You are not logged in.</a>';
						echo '</li>';
					}
					?>
				</ul>
			</div>
		</div>
	</nav>


	<!-- Page Content -->
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="cart-list">
					<h2 class="mb-4">Shopping Cart</h2>
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Check if cart is empty
							if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
								echo '<tr><td colspan="6">Your cart is empty.</td></tr>';
							} else {
								$totalPrice = 0;
								// Output cart contents
								foreach ($_SESSION['cart'] as $index => $item) {
									$totalPrice += $item['price'] * $item['quantity'];
									?>
									<tr>
										<th scope="row"><?php echo $index + 1; ?></th>
										<td><?php echo htmlspecialchars($item['name']); ?></td>
										<td>$<?php echo number_format($item['price'], 2); ?></td>
										<td><?php echo $item['quantity']; ?></td>
										<td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
										<td>
												<button onclick="removeFromCart(<?php echo $index; ?>)" class="btn btn-danger btn-sm">Remove</button>
										</td>
									</tr>
							<?php
								}
							?>
								<tr>
									<td colspan="4" class="text-right"><strong>Total:</strong></td>
									<td colspan="2">$<?php echo number_format($totalPrice, 2); ?></td>
								</tr>
								<tr>
									<td colspan="6" class="text-right">
										<a href="checkout.php?total=<?php echo $totalPrice; ?>" class="btn btn-primary" id="nextStepButton">Next Step</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg-dark text-white mt-5 py-4">
		<div class="container text-center">
			<p>&copy; 2024 Your Website. All Rights Reserved.</p>
		</div>
	</footer>


	<!-- JavaScript files -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- Your custom script -->
<script>
    // Function to remove item from cart
    function removeFromCart(index) {
        // Show confirmation message
        if (confirm("Are you sure you want to remove this item from your cart?")) {
            // If user confirms, send AJAX request to remove the item
            $.ajax({
                type: "POST",
                url: "removeFromCart.php",
                data: { index: index },
                success: function(response) {
                    // If the removal was successful, update the cart section
                    if (response.success) {
                        updateCartSection(response.cartHtml);
                    } else {
                        alert("Failed to remove item from cart.");
                    }
                }
            });
        }
    }

    // Function to update cart section dynamically
    function updateCartSection(cartHtml) {
        // Update the cart list with the new HTML content
        $('.cart-list').html(cartHtml);

        // Parse the returned HTML data to extract the total price
        var totalPrice = $('.cart-list').find('#cartTotalValue').text();

        // Update the cart total dynamically
        $('#cartTotal').text('$' + totalPrice);
    }

    $(document).ready(function () {
        // Initial call to update cart section
        updateCartSection();

        // Click event listener for the "Next Step" button
        $('#nextStepButton').click(function () {
            var totalPrice = $('#cartTotal').text().substring(1); // Remove the $ sign
            window.location.href = 'checkout.php?total=' + totalPrice;
        });
    });
    
    // Refresh page after confirmation alert
    function refreshPage() {
        window.location.reload();
    }

    // Override the default alert function
    window.alert = function(msg) {
        setTimeout(function() {
            refreshPage();
        }, 1000); // Refresh after 2 seconds
        return true;
    };
</script>



</body>

</html>
