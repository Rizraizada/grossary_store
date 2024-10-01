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
    public function getProductById($productId)
    {
        $sql = "SELECT * FROM `products` WHERE `product_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inside your Product class
    public function searchProducts($keyword){
        try {
            $query = "SELECT * FROM products WHERE product_name LIKE ?";
            $stmt = $this->conn->prepare($query);
            $keywordPattern = "%$keyword%";
            $stmt->bind_param('s', $keywordPattern);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error searching products: " . $e->getMessage());
        }
    }


}

// Instantiate Product class 
