<?php 
require_once '../config/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Prepare the SQL statement to retrieve the product details
    $query = $conn->prepare("SELECT products.product_name, products.price, products.stock, categories.category_name 
        FROM products 
        INNER JOIN categories ON products.category_id = categories.id 
        WHERE products.id = ?
    ");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    // Close the query statement
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>



<body>
    <h2>Product <?= $row["product_name"] ?></h2>
    <p>Price: <?= $row["price"] ?></p>
    <p>Quantity: <?= $row["stock"] ?></p>
    <p>Category: <?= $row["category_name"] ?></p>
    <a href="../controller/delete_product.php?id=<?= $id ?>">Delete Product</a>
</body>
</html>