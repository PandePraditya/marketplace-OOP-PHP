<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Categories</title>
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
    <h2>Add Category</h2>
    <a href="../index.php">Back to Home</a>
    <form action="../controller/process_category.php" method="POST">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" id="category_name">
        <button type="submit">Submit</button>
    </form>
</body>
</html>