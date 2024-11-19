<?php
require_once "config/connection.php";

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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

    a {
        text-decoration: none;
        margin: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .kembali {
        padding: 5px;
        margin: 10px 5px;
        background-color: #007bff;
        border-radius: 5px;
        color: white;
        text-decoration: none;
    }
</style>

<body>
    <main>
        <h2>Category List</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            <!-- Show data with php and html -->
            <?php if (count($categories) > 0) : ?>
                <?php $counter = 1 ?>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $category["category_name"] ?></td>
                        <td>
                            <a href="view/update_category_view.php?id=<?php echo $category["id"] ?>">Update</a> |
                            <a href="view/delete_category_view.php?id=<?php echo $category["id"] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">No categories found</td>
                </tr>
            <?php endif ?>
        </table>

        <a href="index.php" class="kembali">Kembali</a>
    </main>
</body>

</html>