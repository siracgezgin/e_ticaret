<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM urunler WHERE urun_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION['success'] = "Ürün başarıyla silindi.";
} else {
    $_SESSION['error'] = "Geçersiz ürün ID'si.";
}

header("Location: products.php");
exit;
?>
