<?php
include_once('../config/db.php');

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM categories WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: ../category.php");
    exit();
} catch (PDOException $e) {
    echo "Error deleting record: " . $e->getMessage();
}

$conn = null;
?>