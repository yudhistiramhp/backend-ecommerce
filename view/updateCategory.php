<?php
require(__DIR__ . '/../config/init.php');

$id = $_GET['id'];

$categoryController = new CategoryController();
$category = $categoryController->show($id);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);

    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $data = ['category_name' => $_POST['category_name']];;
    }

    if (empty($errors)) {

        if ($categoryController->update($id, $data)) {
            header("Location: ../category.php");
            exit();
        } else {
            echo "<script>alert('Failed to Update category!')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>

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
            color: darkorange;
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
    <h2>Update Category</h2>
    <a class="back-button" href="../category.php">Back to Category List</a>
    <br><br>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" required>
        <br><br>
        <input type="submit" value="Update Category">
    </form>
</body>

</html>