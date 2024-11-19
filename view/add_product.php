<?php
require_once '../controller/ProductController.php';

$productController = new ProductController();
$categories = $productController->create();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'product_name' => $_POST["product_name"],
        'price' => $_POST["price"],
        'stock' => $_POST["stock"],
        'category_id' => $_POST["category_id"]
    ];

    if ($productController->store($data)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: Unable to add product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    label {
        display: block;
    }

    input {
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid black;
        border-radius: 5px;
        width: 100%;
    }

    select {
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid black;
        border-radius: 5px;
        width: 100%;
    }

    button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<body>
    <h2>Add Product</h2>
    <a href="../">Back to Home</a>
    <form action="../controller/process_product.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="price">Price:</label>
        <input type="number" name="price" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>

        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <option value="">Select a Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Product</button>
    </form>
</body>

</html>