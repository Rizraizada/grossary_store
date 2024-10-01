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

// Query to fetch all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="x/https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="x/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
session_start();

if (!isset($_SESSION["username"])) {
    // If not logged in, redirect to login page
    header("Location: admin_login.html");
    exit(); // Stop executing further
}

$welcome_message = "Welcome, " . $_SESSION["username"] . "!";

?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <?php
                if (isset($_SESSION["username"])) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="#">' . $_SESSION["username"] . '</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<form action="admin_logout.php" method="post">';
                    echo '<button type="submit" class="btn btn-success ml-2" style="margin-top: 15px;">Logout</button>';
                    echo '</form>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="#">You are not logged in.</a>';
                    echo '</li>';
                }
                ?>
            </li>
        </ul>
    </nav>




    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="admin_dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Category</div>
                        <a class="nav-link" href="add_category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Add Category
                        </a>
                        <a class="nav-link" href="add_subcategory.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Add Subcategory
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>

                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                 
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>

                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Products</div>
                        <a class="nav-link" href="product.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Add Product
                        </a>
                        <div class="sb-sidenav-menu-heading">Orders</div>
                        <a class="nav-link" href="Order.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Recent Order
                        </a>

                    </div>
                </div>
               
            </nav>
        </div>
        
        <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">All Orders</h1>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                         <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Country</th>
                                        <th>Street Address</th>
                                        <th>Apartment</th>
                                        <th>Town/City</th>
                                        <th>Postcode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are any orders
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                             echo "<td>" . $row["firstname"] . "</td>";
                                            echo "<td>" . $row["lastname"] . "</td>";
                                            echo "<td>" . $row["country"] . "</td>";
                                            echo "<td>" . $row["streetaddress"] . "</td>";
                                            echo "<td>" . $row["apartment"] . "</td>";
                                            echo "<td>" . $row["towncity"] . "</td>";
                                            echo "<td>" . $row["postcode"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["total"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No orders found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


 
    </div>
    <script src="x/https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="x/js/scripts.js"></script>
    <script src="x/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="x/assets/demo/chart-area-demo.js"></script>
    <script src="x/assets/demo/chart-bar-demo.js"></script>
    <script src="x/https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="x/js/datatables-simple-demo.js"></script>
</body>

</html>