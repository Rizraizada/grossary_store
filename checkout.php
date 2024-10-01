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

    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
	<?php
// Fetch the total price from the URL query parameter
if (isset($_GET['total'])) {
    $totalPrice = $_GET['total'];
} else {
    // Handle the case when the total price is not provided
    $totalPrice = 0;
}
?>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="process_order.php" method="post" class="billing-form">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
						<div class="col-md-12">
                             <div class="form-group">
                                 <label for="country">Country(City)</label>
                                 <select class="form-control" name="country">
                                     <option value="Sydney">Sydney</option>
                                     <option value="Melbourne">Melbourne</option>
                                     <option value="Brisbane">Brisbane</option>
                                     <option value="Perth">Perth</option>
                                     <option value="Adelaide">Adelaide</option>
                                     <option value="Gold Coast">Gold Coast</option>
                                     <option value="Newcastle">Newcastle</option>
                                     <option value="Canberra">Canberra</option>
                                     <option value="Sunshine Coast">Sunshine Coast</option>
                                     <option value="Wollongong">Wollongong</option>
                                     <option value="Hobart">Hobart</option>
                                     <option value="Geelong">Geelong</option>
                                     <option value="Townsville">Townsville</option>
                                     <option value="Cairns">Cairns</option>
                                     <option value="Darwin">Darwin</option>
                                     <option value="Toowoomba">Toowoomba</option>
                                     <option value="Ballarat">Ballarat</option>
                                     <option value="Bendigo">Bendigo</option>
                                     <option value="Albury-Wodonga">Albury-Wodonga</option>
                                     <!-- Add more options for other Australian cities as needed -->
                                 </select>
                             </div>
                         </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Street Address</label>
                                <input type="text" class="form-control" name="streetaddress" placeholder="House number and street name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apartment">Apartment, suite, unit etc:</label>
                                <input type="text" class="form-control" name="apartment" placeholder="Apartment, suite, unit etc. (optional)">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Town / City</label>
                                <input type="text" class="form-control" name="towncity" placeholder="Town / City" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcode">Postcode *</label>
                                <input type="text" class="form-control" name="postcode" placeholder="Postcode" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                        </div>
                    </div>
					<input type="hidden" name="total" value="<?php echo isset($_GET['total']) ? $_GET['total'] : '0.00'; ?>">

                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>
           <div class="col-xl-5">
    <div class="row mt-5 pt-3">
        <div class="col-md-12 d-flex mb-5">
            <div class="cart-detail cart-total p-3 p-md-4">
                <h3 class="billing-heading mb-4">Cart Total</h3>
                <p class="d-flex total-price">
                    <span>Total</span>
                    <?php
                    // Retrieve the total price from the URL query parameter
                    $totalPrice = isset($_GET['total']) ? $_GET['total'] : '0.00';
                    ?>
                    <span>$<?php echo $totalPrice; ?></span>
                    <input type="hidden" name="total" value="<?php echo $totalPrice; ?>">
                </p>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</section>
 <!-- .section -->
 
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
          <div class="col-md-12 text-center">

           </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
    
  </body>
</html>