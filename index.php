<?php
require_once(__DIR__ . '/config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();
$products = $productController->index();
$categories = $categoryController->index();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            padding-top: 40px;
            font-size: 28px;
            color: #333;
            font-weight: bold;
        }

        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actionDelete,
        .actionUpdate,
        .actionView {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .actionDelete {
            background-color: #e74c3c;
            color: #fff;
        }

        .actionView {
            background-color: #2ecc71;
            color: #fff;
        }

        .actionUpdate {
            background-color: #f39c12;
            color: #fff;
        }

        .actionDelete:hover {
            background-color: #c0392b;
        }

        .actionView:hover {
            background-color: #27ae60;
        }

        .actionUpdate:hover {
            background-color: #e67e22;
        }

        .add,
        .next {
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            display: inline-block;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }

        .add {
            background-color: #2980b9;
            float: left;
            margin-left: 150px;
        }

        .next {
            background-color: #8e44ad;
            float: right;
            margin-right: 150px;
        }

        .add:hover {
            background-color: #1f618d;
        }

        .next:hover {
            background-color: #9b59b6;
        }

        .no-products {
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 20px;
        }

    </style>
</head>

<body>
    <h2>Product List</h2>
    <a class="add" href="view/addProduct.php">Add Product</a>
    <a class="next" href="category.php">Category List</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>

        <?php if (!empty($products)) : ?>
            <?php $counter = 1 ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $product["product_name"] ?></td>
                    <td>
                        <?php
                        $categoryName = "";
                        foreach ($categories as $category) {
                            if ($category['id'] == $product['category_id']) {
                                $categoryName = $category['category_name'];
                                break;
                            }
                        }
                        echo $categoryName;
                        ?>
                    </td>

                    <td><?php echo number_format($product["price"], 0, ',', '.') ?></td>
                    <td><?php echo $product["stock"] ?></td>
                    <td>
                        <a class="actionView" href="view/detailProduct.php?id=<?php echo $product["id"] ?>">View</a>
                        <a class="actionUpdate" href="view/updateProduct.php?id=<?php echo $product["id"] ?>">Update</a>
                        <a class="actionDelete" href="view/deleteProduct.php?id=<?php echo $product["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php $counter++ ?>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="no-products">No products found</td>
            </tr>
        <?php endif ?>
    </table>

</body>

</html>
