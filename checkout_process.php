<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

// Sepetteki ürünleri faturaya ekle
$query = "SELECT urun_id, adet FROM sepet WHERE kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();

// Fatura tablosuna eklemek için her ürünü döngüye al
while ($row = $result->fetch_assoc()) {
    $urun_id = $row['urun_id'];
    $adet = $row['adet'];

    // Her bir ürün için fatura tablosuna ekleme yap
    $insert_query = "INSERT INTO fatura (kullanici_id, urun_id, adet, tarih) VALUES (?, ?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("iii", $kullanici_id, $urun_id, $adet);
    $insert_stmt->execute();
}

// Sepeti temizle
$delete_query = "DELETE FROM sepet WHERE kullanici_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$delete_stmt->bind_param("i", $kullanici_id);
$delete_stmt->execute();

$_SESSION['success'] = "Siparişiniz başarıyla alındı. Faturanızı inceleyebilirsiniz.";
header("Location: invoice.php");
exit;
?>
