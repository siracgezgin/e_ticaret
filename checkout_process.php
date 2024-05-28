<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

// Step 1: Create a new invoice in the fatura table
$insert_fatura_query = "INSERT INTO fatura (kullanici_id, tarih) VALUES (?, NOW())";
$insert_fatura_stmt = $conn->prepare($insert_fatura_query);
$insert_fatura_stmt->bind_param("i", $kullanici_id);
$insert_fatura_stmt->execute();
$fatura_id = $conn->insert_id; // Get the generated fatura_id

// Step 2: Get the products from the user's cart
$query = "SELECT urun_id, adet FROM sepet WHERE kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();

// Step 3: Insert each product into the fatura_detaylari table
while ($row = $result->fetch_assoc()) {
    $urun_id = $row['urun_id'];
    $adet = $row['adet'];

    // Get the product price from the urunler table
    $price_query = "SELECT fiyat FROM urunler WHERE urun_id = ?";
    $price_stmt = $conn->prepare($price_query);
    $price_stmt->bind_param("i", $urun_id);
    $price_stmt->execute();
    $price_result = $price_stmt->get_result();
    $price_row = $price_result->fetch_assoc();
    $birim_fiyat = $price_row['fiyat'];

    // Insert the product details into the fatura_detaylari table
    $insert_detail_query = "INSERT INTO fatura_detaylari (fatura_id, urun_id, adet, birim_fiyat) VALUES (?, ?, ?, ?)";
    $insert_detail_stmt = $conn->prepare($insert_detail_query);
    $insert_detail_stmt->bind_param("iiid", $fatura_id, $urun_id, $adet, $birim_fiyat);
    $insert_detail_stmt->execute();
}

// Step 4: Clear the user's cart
$delete_query = "DELETE FROM sepet WHERE kullanici_id = ?";
$delete_stmt = $conn->prepare($delete_query);
$delete_stmt->bind_param("i", $kullanici_id);
$delete_stmt->execute();

$_SESSION['success'] = "Siparişiniz başarıyla alındı. Faturanızı inceleyebilirsiniz.";
header("Location: invoice.php");
exit;
?>
