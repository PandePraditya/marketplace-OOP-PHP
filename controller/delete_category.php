<?php 
require_once '../config/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Check if any products are associated with this category
    $checkQuery = $conn->prepare("SELECT COUNT(*) as product_count FROM products WHERE category_id = ?");
    $checkQuery->bind_param("i", $id); // "i" for integer
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result(); // Get the result 
    $countRow = $checkResult->fetch_assoc(); // Fetch the row
    $checkQuery->close();

    // If products are associated with this category, prevent deletion
    if ($countRow['product_count'] > 0) {
        echo "Cannot delete category. There are products associated with this category.";
    } else {
        // No products are associated, proceed with deletion
        $query = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $query->bind_param("i", $id); // "i" for integer

        if ($query->execute()) {
            header("Location: ../index.php");  // Redirect to the main page after deletion
            exit();
        } else {
            echo "Error deleting category: " . $query->error;
        }

        $query->close();
    }
}
