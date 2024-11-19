<?php 
require_once '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $categoryName = $_POST["category_name"];

    try {
        // Prepare the SQL statement to update only the category name
        $query = $conn->prepare("UPDATE categories SET category_name = ? WHERE id = ?");
        
        // Bind parameters (s - string, i - integer)
        $query->bind_param("si", $categoryName, $id);

        // Execute the prepared statement
        if ($query->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error updating record: " . $query->error;
        }
        $query->close();
    } catch (Exception $e) {
        echo "Error updating record: " . $e->getMessage();
    }
}
?>
