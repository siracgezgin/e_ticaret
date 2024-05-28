<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urun_adi = $_POST['isim']; // Değişken adını düzelt
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];

    $query = "INSERT INTO urunler (isim, aciklama, fiyat) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssd", $urun_adi, $aciklama, $fiyat);
    
    if ($stmt->execute()) {
        // Yeni eklenen ürünün eklenen ID'sini al
        $new_product_id = $stmt->insert_id;

        // Eklenen ürünün detaylarına erişmek için veritabanından tekrar sorgulama yap
        $query = "SELECT * FROM urunler WHERE urun_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $new_product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Eklenen ürünün detaylarını kullanarak bir bildirim oluştur
        $_SESSION['success'] = "Yeni ürün başarıyla eklendi: " . $row['isim']; // Değişken adını düzelt
    } else {
        $_SESSION['error'] = "Ürün eklenirken bir hata oluştu.";
    }

    // Yönlendirme işlemi
    header("Location: products.php");
    exit;
} else {
    // Post metodu dışında erişim olursa
    $_SESSION['error'] = "Bu sayfaya doğrudan erişim yapılamaz.";
    header("Location: products.php");
    exit;
}
?>
