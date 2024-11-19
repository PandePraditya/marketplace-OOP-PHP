<?php
require_once '../config/connection.php';

class Product {
    private $conn;

    public function __construct() {
        $db = new Connection();
        $this->conn = $db->connect();
    }

    public function getProducts() {
        $sql = "SELECT products.id, products.product_name, products.price, products.stock, categories.category_name
                FROM products
                JOIN categories ON products.category_id = categories.id";
        $result = $this->conn->query($sql);

        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    public function getProductById($id) {
        $query = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function addProduct($product_name, $price, $stock, $category_id) {
        $query = $this->conn->prepare("INSERT INTO products (product_name, price, stock, category_id) VALUES (?, ?, ?, ?)");
        $query->bind_param("sidi", $product_name, $price, $stock, $category_id);
        return $query->execute();
    }

    public function updateProduct($id, $product_name, $price, $stock, $category_id) {
        $query = $this->conn->prepare("UPDATE products SET product_name=?, price=?, stock=?, category_id=? WHERE id=?");
        $query->bind_param("siiii", $product_name, $price, $stock, $category_id, $id);
        return $query->execute();
    }

    public function deleteProduct($id) {
        $query = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $query->bind_param("i", $id);
        return $query->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
