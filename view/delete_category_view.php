<?php 
require_once '../config/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Query to get the category details
    $query = $conn->prepare("SELECT category_name FROM categories WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $category = $result->fetch_assoc();

    // Close the query statement
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>
</head>
<body>
    <?php if ($category): ?>
        <h2>Category: <?= htmlspecialchars($category["category_name"]) ?></h2>
        <a href="../controller/delete_category.php?id=<?= $id ?>">Delete Category</a>
    <?php else: ?>
        <p>Category not found.</p>
    <?php endif; ?>
</body>
</html>
