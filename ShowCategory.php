<?php
require_once(__DIR__ . '/Config/init.php');

$categoryController = new CategoryController();

$categories = $categoryController->index(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreCategoryId"])) {
    $categoryController->restore($_POST["restoreCategoryId"]);
    header("Location: ShowCategory.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Category List</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="View/category/create.php" class="btn btn-primary me-3">Add New Category</a>
            <a href="index.php" class="btn btn-success">Go to Product List</a>
        </div>

        <?php if (!empty($categories)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $loopIndex = 1; // Initialize loop index starting from 1
                        foreach ($categories as $category): 
                    ?>
                        <tr>
                            <td><?= $loopIndex++; ?></td> <!-- Display sequential number -->
                            <td><?= htmlspecialchars($category['id']); ?></td> <!-- ID in database -->
                            <td><?= htmlspecialchars($category['category_name']); ?></td>
                            <td>
                                <a href="View/category/detail.php?id=<?= $category['id']; ?>" class="btn btn-warning btn-sm">Detail</a>
                                <a href="View/category/update.php?id=<?= $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="View/category/delete.php?id=<?= $category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No categories found.</p>
        <?php endif; ?>
        
        <form method="POST">
            <input type="hidden" name="restoreCategoryId" value="<?= $category['id']; ?>">
            <button type="submit" class="btn btn-secondary">Restore All</button>
        </form>
    </div>
</body>

</html>