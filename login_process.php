<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, sifre FROM kullanicilar WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['kullanici_id'] = $id;
            $_SESSION['kullanici_email'] = $email;
            header("Location: products.php");
        } else {
            $_SESSION['error'] = "Yanlış şifre. Lütfen tekrar deneyin.";
            header("Location: login.php");
        }
    } else {
        $_SESSION['error'] = "Kullanıcı bulunamadı. Lütfen tekrar deneyin.";
        header("Location: login.php");
    }

    $stmt->close();
    $conn->close();
}
?>
