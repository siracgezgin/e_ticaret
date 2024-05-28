<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$siparis_id = $_GET['id'];

$delete_stmt = $conn->prepare("DELETE FROM siparisler WHERE urun_id = ? AND kullanici_id = ?");
$delete_stmt->bind_param("ii", $siparis_id, $kullanici_id);
$delete_stmt->execute();

$_SESSION['success'] = "Sipariş başarıyla silindi.";
header("Location: invoice.php");
?>
