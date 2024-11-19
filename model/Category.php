<?php
require_once '../config/connection.php';

class Category {
    private $conn;

    public function __construct() {
        $db = new Connection();
        $this->conn = $db->connect();
    }

    public function getCategories() {
        $sql = "SELECT id, category_name FROM categories";
        $result = $this->conn->query($sql);
        
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
