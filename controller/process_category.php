<?php 
    require_once '../config/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $categories = $_POST["category_name"];
    
        try {
            // Prepare the SQL statement
            $query = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    
            // Bind parameters (s - string, d - double, i - integer)
            $query->bind_param("s", $categories);
    
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
    $conn->close();