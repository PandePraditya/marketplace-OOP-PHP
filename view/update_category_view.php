<?php 
require_once '../config/connection.php';

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    // Close the statement
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
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

    a {
        padding: 5px;
        margin: 5px;
        background-color: #007bff;
        border-radius: 5px;
        color: white;
        text-decoration: none;
    }
</style>

<body>
    <h2>Update Category</h2>
    <?php if ($row): ?>
        <form action="../controller/update_category.php" method="POST">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>" required>
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Update Category</button>
        </form>
    <?php else: ?>
        <p>Category not found.</p>
    <?php endif; ?>
    <a href="../show_category.php">Kembali</a>
</body>
</html>
