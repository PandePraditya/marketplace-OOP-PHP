<?php 
    require_once '../config/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_name = $_POST["product_name"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $category_id = $_POST["category_id"];    
        $id = $_POST["id"];

        try {
            // Prepare the SQL statement
            $query = $conn->prepare("UPDATE products SET product_name=?, price=?, stock=?, category_id=? WHERE id=?");

            // Bind parameters (s - string, d - double, i - integer)
            $query->bind_param("siiii", $product_name, $price, $stock, $category_id, $id);

            // Execute the prepared statement 
            if ($query->execute()) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $query->error;
            }

            $query->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }