<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

$query = "SELECT sepet.id AS sepet_id, urunler.urun_id AS id, urunler.isim, urunler.fiyat, sepet.adet FROM sepet INNER JOIN urunler ON sepet.urun_id = urunler.urun_id WHERE sepet.kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();

$total_price = 0;
while ($row = $result->fetch_assoc()) {
    $total_price += $row['adet'] * $row['fiyat'];
}

if ($total_price == 0) {
    $_SESSION['error'] = "Sepetiniz boş. Lütfen önce sepetinize ürün ekleyin.";
    header("Location: cart.php");
    exit;
}

// Sepet boş değilse, siparişi işleme koy
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $adet = $row['adet'];
    $fiyat = $row['fiyat'];
    $toplam_fiyat = $adet * $fiyat;
    
    $order_stmt = $conn->prepare("INSERT INTO siparisler (kullanici_id, urun_id, adet, toplam_fiyat) VALUES (?, ?, ?, ?)");
    $order_stmt->bind_param("iiid", $kullanici_id, $id, $adet, $toplam_fiyat);
    $order_stmt->execute();
    $order_stmt->close();
}

$clear_cart_stmt = $conn->prepare("DELETE FROM sepet WHERE kullanici_id = ?");
$clear_cart_stmt->bind_param("i", $kullanici_id);
$clear_cart_stmt->execute();
$clear_cart_stmt->close();

$stmt->close();
$conn->close();

$_SESSION['success'] = "Siparişiniz başarıyla alındı.";
header("Location: invoice.php");
?>
