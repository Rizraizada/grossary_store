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
			<a class="navbar-brand" href="index.html">Vegefoods</a>
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


	<!-- END nav -->
	<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item" style="position: relative; background-image: url(images/bg_1.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">We serve Fresh Vegetables & Fruits</h1>
						<form action="" method="GET" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); display: flex; align-items: center;">
                    <input type="text" name="search" placeholder="Search for products..." style="flex: 1; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px;">
                    <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Search</button>
                </form>
                    </div>

                </div>
                <!-- Display search form -->
                
            </div>
        </div>


    </div>
</section>


 

	 

	<style>
    .product .img-prod {
        width: 100%;
        height: 200px; /* Set the fixed height for the image container */
        overflow: hidden; /* Hide any overflow to maintain the fixed height */
    }

    .product .img-prod img {
        width: 100%;
        height: auto;
    }
</style>



<?php
// Include the Database and Product classes
require_once('structure.php');

// Instantiate Database class 
$database = new Database();
$conn = $database->getConnection();

// Instantiate Product class 
$product = new Product($conn);

// Check if search query is present
if (isset($_GET['search'])) {
    // Perform search and display search results
    $searchQuery = $_GET['search'];
    $searchResults = $product->searchProducts($searchQuery);
    ?>
    <div class="container">
	<div class="container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
 
</div>
        <?php
        if (!empty($searchResults)) {
            echo '<div class="row">';
			foreach ($searchResults as $result) {
				echo '<div class="col-md-3 ftco-animate">';
				echo '<div class="product">';
				echo '<a href="product-details.php?id=' . $result['product_id'] . '" class="img-prod"><img class="img-fluid" src="admin/uploads/' . basename($result["image"]) . '" alt="' . $result["product_name"] . '">';
				echo '<span class="status">' . ($result["in_stock"] == 0 ? 'Out of Stock' : ($result["in_stock"] == 1 ? 'New' : '')) . '</span>';
				echo '<div class="overlay"></div></a>';
				echo '<div class="text py-3 pb-4 px-3 text-center">';
				echo '<h3>' . $result["product_name"] . '</h3>';
				echo '<div class="d-flex">';
				echo '<div class="pricing">';
				echo '<p class="price"><span class="mr-2">$' . number_format($result["unit_price"], 2) . '</span></p>';
				echo '</div>';
				echo '</div>';
				echo '<div class="bottom-area d-flex px-3">';
				echo '<div class="m-auto d-flex">';
				if (isLoggedIn() && $result['in_stock'] != 0) {
					echo '<a href="#" class="add-to-cart d-flex justify-content-center align-items-center mx-1" 
						   data-id="' . $result['product_id'] . '" 
						   data-name="' . $result['product_name'] . '" 
						   data-price="' . $result['unit_price'] . '">
						   <span>Cart</span>
						 </a>';
				} elseif ($result['in_stock'] != 0) {
					echo '<span class="add-to-cart d-flex justify-content-center align-items-center mx-1" onclick="showLoginMessage()">
						   <span>Cart</span>
						 </span>';
				}
				echo '<a href="#" class="heart d-flex justify-content-center align-items-center ">
						<span><i class="ion-ios-heart"></i></span>
					  </a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			
            echo '</div>'; // Close row
        } else {
            echo '<p>No results found.</p>';
        }
        ?>
    </div>
<?php
} else {
    // Display all products
    ?>
    <div class="container"style="margin-top:100px">
    
        <div class="row">
            <?php
            try {
                // Retrieve products from the database
                $products = $product->getAllProducts();

                // Output products 
                foreach ($products as $prod) {
                    ?>
                    <div class="col-md-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod"><img class="img-fluid" src="admin/uploads/<?php echo basename($prod["image"]); ?>" alt="<?php echo $prod["product_name"]; ?>">
                                <span class="status"><?php echo $prod["in_stock"] == 0 ? 'Out of Stock' : ($prod["in_stock"] == 1 ? 'New' : ''); ?></span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><?php echo $prod["product_name"]; ?></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span class="mr-2">$<?php echo number_format($prod["unit_price"], 2); ?></span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <?php if (isLoggedIn() && $prod['in_stock'] != 0) : ?>
                                            <a href="#" class="add-to-cart d-flex justify-content-center align-items-center mx-1" 
                                               data-id="<?php echo $prod['product_id']; ?>" 
                                               data-name="<?php echo $prod['product_name']; ?>" 
                                               data-price="<?php echo $prod['unit_price']; ?>">
                                                <span>Cart</span>
                                            </a>
                                        <?php elseif ($prod['in_stock'] != 0) : ?>
                                            <span class="add-to-cart d-flex justify-content-center align-items-center mx-1" onclick="showLoginMessage()">
                                                <span>Cart</span>
                                            </span>
                                        <?php endif; ?>
                                        <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>
        </div> <!-- /.row -->
    </div>
<?php } ?>


<?php
// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['username']);
}
?>

<script>
function showLoginMessage() {
    alert("Please login first to add items to the cart.");
    // You can also redirect users to the login page instead of showing an alert
    // window.location.href = "login.php";
}
</script>


<!-- /.container -->
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- Your existing HTML and PHP code -->

<script>
    $(document).ready(function() {
        $(document).off('click', '.add-to-cart').on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            var productName = $(this).data('name');
            var productPrice = $(this).data('price');
			var productImage = $(this).data('image');

            addToCart(productId, productName, productPrice);
        });

        function addToCart(id, name, price) {
            $.ajax({
                type: 'POST',
                url: 'addToCart.php',
                data: { id: id, name: name, price: price },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success) {
                        // Update cart dynamically
                        updateCartSection();
						window.location.href = 'cart.php';
                    } else {
                        alert('Failed to add product to cart. ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while adding product to cart. Please try again later.');
                    console.error(xhr.responseText);
                }
            });
        }

        function updateCartSection() {
            // Update cart section dynamically without reloading
            $.get('cart.php', function(data) {
                $('#cart-section').html(data);
            });
        }
    });
</script>



	 

	 

	 
	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Vegefoods</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="#" class="py-2 d-block">Shop</a></li>
							<li><a href="#" class="py-2 d-block">About</a></li>
							<li><a href="#" class="py-2 d-block">Journal</a></li>
							<li><a href="#" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">FAQs</a></li>
								<li><a href="#" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="" target="_blank">GrossaryStore</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
		</div>
	</footer>

	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>


	<script>
		$(document).ready(function() {
    $('#btnNavbarSearch').on('click', function() {
        var keyword = $('input[type="text"]').val().trim();
        if (keyword !== '') {
            // Perform AJAX request to retrieve search results
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: { keyword: keyword },
                success: function(response) {
                    // Handle the response and display search results
                    $('#searchResults').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});

	</script>
 
</body>

</html>