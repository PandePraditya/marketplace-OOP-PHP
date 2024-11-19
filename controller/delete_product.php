<?php 
require_once '../config/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Prepare the SQL statement to delete the product
    $query = $conn->prepare("DELETE FROM products WHERE id = ?");
    $query->bind_param("i", $id); // "i" for integer
    $query->execute(); // Execute the prepared statement
    $query->close(); // Close the statement
    header("Location: ../index.php"); 
    exit();
}