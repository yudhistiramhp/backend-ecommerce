<?php
require(__DIR__ . '/../config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();
$categories = $categoryController->index();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $data['product_name'] = $_POST['product_name'];
    }

    if (empty($_POST["category_id"])) {
        $errors['category_id'] = "Category is required";
    } else {
        $data['category_id'] = $_POST["category_id"];
    }

    if (empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else if (!is_numeric($_POST["price"])) {
        $errors['price'] = "Price must be a number";
    } else if (floatval($_POST["price"]) <= 0) {
        $errors['price'] = "Price should be greater than zero";
    } else {
        $data['price'] = $_POST["price"];
    }

    if (empty($_POST["stock"])) {
        $errors['stock'] = "Stock is required";
    } else if (!is_numeric($_POST["stock"])) {
        $errors['stock'] = "Stock must be a valid number";
    } else if ((int)$_POST["stock"] < 0) {
        $errors['stock'] = "Stock cannot be negative";
    } else if ($_POST["stock"] != (string)(int)$_POST["stock"]) {
        $errors['stock'] = "Stock must be an integer";
    } else {
        $data['stock'] = $_POST["stock"];
    }

    if (empty($errors)) {
        if ($productController->create($data)) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Failed to add product!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            padding-top: 70px;
            color: #2980b9;
        }

        .back-button {
            color: white;
            text-decoration: none;
            background-color: #2980b9;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 370px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #1f618d;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2980b9;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #1f618d;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .error-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>Add Product</h2>
    <a class="back-button" href="../index.php">Back to Product List</a>
    <br><br>

    <form action="" method="post">
        <label for="product_name">Product Name :</label>
        <input type="text" name="product_name" required>
        <br><br>

        <label for="category_id">Category :</label>
        <select class="form-select" name="category_id" required>
            <option value="" disabled selected>Select Category</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>" <?= isset($_POST['category_id']) && $_POST['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                    <?= $category['category_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="price">Price :</label>
        <input type="text" name="price" required>
        <br><br>

        <label for="stock">Stock :</label>
        <input type="text" name="stock" required>
        <br><br>

        <input type="submit" value="Add Product">
    </form>

</body>

</html>