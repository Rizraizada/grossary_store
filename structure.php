<?php

// Database connection class 
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "grocery_store";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Category class 
class Category
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM `category`";
        $result = $this->conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
}

// Sub-category class 
class SubCategory
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getSubCategoriesByCategoryId($cat_id)
    {
        $sql = "SELECT * FROM category_sub WHERE cat_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $subCategories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subCategories[] = $row;
            }
        }
        return $subCategories;
    }
}

// Instantiate Database class 
$database = new Database();
$conn = $database->getConnection();

// Instantiate Category class 
$category = new Category($conn);
$categories = $category->getAllCategories();

// Instantiate SubCategory class 
$subCategory = new SubCategory($conn);

// Output category and sub-category dropdowns 
// Output category and sub-category dropdowns 
foreach ($categories as $cat) {
    echo '<a class="dropdown-item dropdown-toggle category-item" href="#" data-catid="' . $cat["cat_id"] . '">' . $cat["cat_name"] . '</a>';
    $subCategories = $subCategory->getSubCategoriesByCategoryId($cat["cat_id"]);
    if (!empty($subCategories)) {
        echo '<div class="dropdown-menu subcategory-menu" data-catid="' . $cat["cat_id"] . '">';
        foreach ($subCategories as $subCat) {
            echo '<a class="dropdown-item subcategory-item" href="product-single.html">' . $subCat["cat_sub_name"] . '</a>';
        }
        echo '</div>'; // Close nested dropdown menu 
    }
}



// Close database connection 
$database->closeConnection();

// CategoryManager class 
class CategoryManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM `category`";
        $result = $this->conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
}

// SubCategoryManager class 
class SubCategoryManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getSubCategoriesByCategoryId($cat_id)
    {
        $sql = "SELECT * FROM category_sub WHERE cat_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $subCategories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subCategories[] = $row;
            }
        }
        return $subCategories;
    }
}

// Instantiate Product class 
class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM `products`";
        $result = $this->conn->query($sql);
        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
}

// Instantiate Product class 
