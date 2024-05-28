<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$siparis_id = $_POST['siparis_id'];
$adet = $_POST['adet'];

$query = "SELECT urunler.fiyat FROM siparisler INNER JOIN urunler ON siparisler.urun_id = urunler.urun_id WHERE siparisler.kullanici_id = ? AND siparisler.urun_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $kullanici_id, $siparis_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: invoice.php");
    exit;
}

$siparis = $result->fetch_assoc();
$fiyat = $siparis['fiyat'];
$toplam_fiyat = $adet * $fiyat;

$update_stmt = $conn->prepare("UPDATE siparisler SET adet = ?, toplam_fiyat = ? WHERE urun_id = ? AND kullanici_id = ?");
$update_stmt->bind_param("idii", $adet, $toplam_fiyat, $siparis_id, $kullanici_id);
$update_stmt->execute();

$_SESSION['success'] = "Sipariş başarıyla güncellendi.";
header("Location: invoice.php");
?>
