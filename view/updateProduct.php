<?php
require(__DIR__ . '/../config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$categoryController = new CategoryController();
$product = $productController->show($id);

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
        if ($productController->update($id, $data)) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Failed to update product!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
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
            color: #f39c12;
        }

        .back-button {
            color: white;
            text-decoration: none;
            background-color: #f39c12;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 370px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #e67e22;
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
            color: #f39c12;
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
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #e67e22;
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
    <h2>Update Product</h2>
    <a class="back-button" href="../index.php">Back to Products</a>
    <br><br>
    <form action="" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo ($product['product_name']); ?>" required>
        <?php if (isset($errors['product_name'])) : ?>
            <div class="error"><?php echo $errors['product_name']; ?></div>
        <?php endif; ?>
        <br><br>
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>"
                    <?= $category['id'] === $product['category_id'] ? 'selected' : '' ?>>
                    <?= ($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="price">Price:</label>
        <input type="text" name="price" value="<?= number_format($product["price"], 0, '', '') ?>" required>
        <?php if (isset($errors['price'])) : ?>
            <div class="error"><?php echo $errors['price']; ?></div>
        <?php endif; ?>
        <br><br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" value="<?= $product['stock']; ?>" required>
        <?php if (isset($errors['stock'])) : ?>
            <div class="error"><?php echo $errors['stock']; ?></div>
        <?php endif; ?>
        <br><br>
        <input type="submit" value="Update Product">
    </form>
</body>

</html>
