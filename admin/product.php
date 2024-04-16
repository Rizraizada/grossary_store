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
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
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

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>



        <div id="layoutSidenav_content">
            <main>

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

                // Retrieve data from the category table
                $sql = "SELECT cat_id, cat_name FROM category";
                $result = $conn->query($sql);
                ?>

                <div id="layoutSidenav_content">
                    <main>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8" style="margin-right: 200px;">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="text-center">Add Product</h2>
                                        </div>
                                        <div class="card-body">
                                            <form action="store_product.php" method="post" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="product_name" class="form-label">Product Name:</label>
                                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="unit_price" class="form-label">Unit Price:</label>
                                                        <input type="text" class="form-control" id="unit_price" name="unit_price" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="unit_quantity" class="form-label">Unit Quantity:</label>
                                                        <input type="text" class="form-control" id="unit_quantity" name="unit_quantity" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="in_stock" class="form-label">In Stock:</label>
                                                        <input type="text" class="form-control" id="in_stock" name="in_stock" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="cat_id" class="form-label">Category ID:</label>
                                                        <select class="form-select" id="cat_id" name="cat_id" required>
                                                            <?php
                                                            // Output options based on fetched data
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo '<option value="' . $row["cat_id"] . '">' . $row["cat_name"] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No categories found</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="cat_sub_id" class="form-label">Subcategory ID:</label>
                                                        <select class="form-select" id="cat_sub_id" name="cat_sub_id" required>
                                                            <?php
                                                            // Retrieve data from the category_sub table
                                                            $sql_sub = "SELECT cat_sub_id, cat_sub_name FROM category_sub";
                                                            $result_sub = $conn->query($sql_sub);

                                                            // Output options based on fetched data
                                                            if ($result_sub->num_rows > 0) {
                                                                while ($row_sub = $result_sub->fetch_assoc()) {
                                                                    echo '<option value="' . $row_sub["cat_sub_id"] . '">' . $row_sub["cat_sub_name"] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No subcategories found</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="product_image" class="form-label">Product Image:</label>
                                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>


                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>

                <?php
                // Close connection
                $conn->close();
                ?>



            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
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