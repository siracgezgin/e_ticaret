<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$isim = $_POST['isim'];
$email = $_POST['email'];

$update_stmt = $conn->prepare("UPDATE kullanicilar SET isim = ?, email = ? WHERE id = ?");
$update_stmt->bind_param("ssi", $isim, $email, $kullanici_id);
$update_stmt->execute();

$_SESSION['success'] = "Profiliniz başarıyla güncellendi.";
header("Location: profile.php");
?>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$isim = $_POST['isim'];
$email = $_POST['email'];

$update_stmt = $conn->prepare("UPDATE kullanicilar SET isim = ?, email = ? WHERE id = ?");
$update_stmt->bind_param("ssi", $isim, $email, $kullanici_id);
$update_stmt->execute();

$_SESSION['success'] = "Profiliniz başarıyla güncellendi.";
header("Location: profile.php");
?>
