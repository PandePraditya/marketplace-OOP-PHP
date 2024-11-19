<?php 
require_once '../controller/ProductController.php';

$productController = new ProductController();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $product = $productController->show($id);
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
    <?php if ($product): ?>
        <h2>Product <?= htmlspecialchars($product["product_name"]) ?></h2>
        <p>Price: <?= number_format($product["price"], 0) ?></p>
        <p>Quantity: <?= htmlspecialchars($product["stock"]) ?></p>
        <p>Category: <?= htmlspecialchars($product["category_name"]) ?></p>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
    <a href="../">Back</a>
</body>
</html>
