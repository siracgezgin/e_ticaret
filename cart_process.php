<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $urun_id = $_POST['id'];
    $kullanici_id = $_SESSION['kullanici_id'];

    if ($action === "add") {
        // Sepete ekleme işlemi
        $query = "INSERT INTO sepet (kullanici_id, urun_id, adet) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE adet = adet + 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $kullanici_id, $urun_id);
        $stmt->execute();
        $_SESSION['success'] = "Ürün sepete eklendi.";
    } elseif ($action === "remove") {
        // Sepetten çıkarma işlemi
        $query = "UPDATE sepet SET adet = adet - 1 WHERE kullanici_id = ? AND urun_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $kullanici_id, $urun_id);
        $stmt->execute();
        
        // Eğer adet sıfırsa, ürünü sepette bulundurmamak için kaydı sil
        $query_delete = "DELETE FROM sepet WHERE kullanici_id = ? AND urun_id = ? AND adet <= 0";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("ii", $kullanici_id, $urun_id);
        $stmt_delete->execute();

        $_SESSION['success'] = "Ürün sepetten çıkarıldı.";
    }
}

header("Location: cart.php");
exit;
?>
