<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Ürün Ekle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Yeni Ürün Ekle</h2>
    <form action="add_product_process.php" method="post">
        <div class="form-group">
            <label for="isim">Ürün Adı</label>
            <input type="text" class="form-control" id="isim" name="isim" required>
        </div>
        <div class="form-group">
            <label for="aciklama">Açıklama</label>
            <textarea class="form-control" id="aciklama" name="aciklama" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="fiyat">Fiyat</label>
            <input type="number" class="form-control" id="fiyat" name="fiyat" min="0" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Ekle</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
