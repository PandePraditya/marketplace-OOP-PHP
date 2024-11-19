<?php
include_once 'controller/ProductController.php';

$productController = new ProductController();

// Check if an action is set in the URL (e.g., view, edit, delete)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'];

    if ($action === 'view') {
        // View product details
        $product = $productController->edit($id)['product']; // Get product details
        include 'view/detail_product.php'; // Display product details in a separate view
        exit;
    } elseif ($action === 'edit') {
        // Redirect to the update form view
        header("Location: view/update_product_view.php?id=$id");
        exit;
    } elseif ($action === 'delete') {
        // Call delete method and redirect to index after deletion
        $productController->delete($id);
        header("Location: index.php");
        exit;
    }
}

$products = $productController->index(); // Fetch all products
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* Add basic styling */
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Product List</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
        <?php if (count($products) > 0) : ?>
            <?php foreach ($products as $index => $product) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($product["product_name"]) ?></td>
                    <td><?= htmlspecialchars($product["category_name"]) ?></td>
                    <td><?= number_format($product["price"], 0) ?></td>
                    <td><?= $product["stock"] ?></td>
                    <td>
                        <!-- Link to view product details (if needed) -->
                        <a href="index.php?action=view&id=<?= $product["id"] ?>">View</a> |
                        <!-- Link to update product -->
                        <a href="index.php?action=edit&id=<?= $product["id"] ?>">Update</a> |
                        <!-- Link to delete product -->
                        <a href="index.php?action=delete&id=<?= $product["id"] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">No results found</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
