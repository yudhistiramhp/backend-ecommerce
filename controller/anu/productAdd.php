<?php
include_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $categoryId = $_POST["category_id"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    try {
        $stmt = $conn->prepare("INSERT INTO products (product_name, category_id, price, stock) VALUES (:product_name, :category_id, :price, :stock)");
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->execute();
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>