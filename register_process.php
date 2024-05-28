<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO kullanicilar (isim, email, sifre) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Kayıt başarılı! Şimdi giriş yapabilirsiniz.";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin.";
        header("Location: register.php");
    }

    $stmt->close();
    $conn->close();
}
?>
