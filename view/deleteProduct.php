<?php
require_once(__DIR__ . '/../config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$product = $productController->show($id);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($productController->destroy($id)) {
        echo "<script>alert('Product deleted successfully!');</script>";
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Failed to delete product!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        h2 {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .back-button {
            position: absolute;
            top: -50px;
            left: 0;
            color: #fff;
            text-decoration: none;
            background-color: #e74c3c;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #c0392b;
        }

        p {
            margin: 20px 0;
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: left;
        }

        table tr {
            border-bottom: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            font-size: 16px;
        }

        table td:first-child {
            font-weight: bold;
            color: #555;
            width: 40%;
            text-align: right;
            padding-right: 15px;
        }

        table td:last-child {
            color: #333;
            text-align: left;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #c0392b;
        }

        .not-found {
            color: #888;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="../index.php" class="back-button">Back to Product List</a>
        <h2>Delete Product</h2>
        <?php if (count($product) > 0) : ?>
            <p>Are you sure you want to delete the following product?</p>
            <table>
                <tr>
                    <td>ID:</td>
                    <td><?php echo $product["id"]; ?></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><?php echo $product["product_name"]; ?></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><?php echo $product["category_name"]; ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>Rp<?php echo number_format($product["price"], 0, ',', '.'); ?></td>
                </tr>
            </table>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="submit" value="Delete Product">
            </form>
        <?php else : ?>
            <p class="not-found">Data not found!</p>
        <?php endif ?>
    </div>
</body>

</html>
