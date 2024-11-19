<?php
require_once(__DIR__ . '/../config/init.php');


$id = $_GET['id'];

$categoryController = new CategoryController();
$category = $categoryController->show($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Category</title>
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
        }

        h2 {
            color: #2ecc71;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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

        .back-button {
            position: absolute;
            top: 150px;
            left: 450px;
            color: #fff;
            text-decoration: none;
            background-color: #2ecc71;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Category</h2>
        <a class="back-button" href="../category.php">Back to Category List</a>
        <br><br>

        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $category["id"]; ?></td>
            </tr>
            <tr>
                <td>Category Name:</td>
                <td><?php echo $category["category_name"]; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>
