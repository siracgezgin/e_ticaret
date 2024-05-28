<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_ticaret";

// Bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Karakter setini utf8mb4 olarak ayarla
$conn->set_charset("utf8mb4");
?>
