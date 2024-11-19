<?php
include_once('../config/db.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST["category_name"];

    try {
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (:category_name)");
        $stmt->bindParam(':category_name', $categoryName);
        $stmt->execute();
        header("Location: ../category.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>