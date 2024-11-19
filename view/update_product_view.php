<?php
require_once '../controller/ProductController.php';

$productController = new ProductController();

// Get product details for the update form
$id = $_GET["id"];
$product = $productController->show($id);
$categories = $productController->create(); // To fetch all categories
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h2>Update Product</h2>
    <form action="../controller/update_product.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>

        <label for="stock">Quantity:</label>
        <input type="text" name="stock" value="<?= htmlspecialchars($product['stock']); ?>" required>

        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <option value="">Select a Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id']; ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($category['category_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
        <button type="submit">Update Product</button>
    </form>
    <a href="../">Back</a>
</body>

</html>