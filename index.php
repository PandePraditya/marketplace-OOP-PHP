<?php
require_once(__DIR__ . '/Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$products = $productController->index();

$categories = $categoryController->index();
$categoryMap = [];
foreach ($categories as $category) {
    $categoryMap[$category['id']] = $category['category_name'];
}

// Handle restoring deleted products
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreProductId"])) {
    $productController->restore($_POST["restoreProductId"]);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Product List</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="View/products/create.php" class="btn btn-primary me-3">Add New Product</a>
            <a href="ShowCategory.php" class="btn btn-success">Go to Category List</a>
        </div>

        <?php if (!empty($products)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $loopIndex = 1; // Initialize loop index starting from 1
                    foreach ($products as $product): 
                    ?>
                        <tr>
                            <td><?= $loopIndex++; ?></td> <!-- Display sequential number -->
                            <td><?= htmlspecialchars($product['id']); ?></td> <!-- ID in database -->
                            <td><?= htmlspecialchars($product['product_name']); ?></td>
                            <td><?= htmlspecialchars($categoryMap[$product['category_id']] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($product['price']); ?></td>
                            <td><?= htmlspecialchars($product['stock']); ?></td>
                            <td>
                                <a href="View/products/detail.php?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Detail</a>
                                <a href="View/products/update.php?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="View/products/delete.php?id=<?= $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>

        <!-- Assuming you want to restore a specific product, this form should be inside the loop or handled differently -->
        <form method="POST">
            <input type="hidden" name="restoreProductId" value="<?= $product['id']; ?>">
            <button type="submit" class="btn btn-secondary">Restore All</button>
        </form>
    </div>
</body>

</html>