<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

$query = "SELECT * FROM kullanicilar WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();
$kullanici = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <div class="mt-5">
        <a href="invoice.php" class="btn btn-info">Önceki Siparişler</a>
    </div>
    <h2 class="mt-5">Profil</h2>
    <form action="update_profile.php" method="post">
        <div class="form-group">
            <label for="isim">İsim</label>
            <input type="text" class="form-control" id="isim" name="isim" value="<?php echo htmlspecialchars($kullanici['isim']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($kullanici['email']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
    <h2 class="mt-5">Şifre Değiştir</h2>
    <form action="change_password.php" method="post">
        <div class="form-group">
            <label for="current_password">Mevcut Şifre</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Yeni Şifre</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Değiştir</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
