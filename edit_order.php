<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$siparis_id = $_GET['id'];

$query = "SELECT siparisler.urun_id, urunler.isim, siparisler.adet, siparisler.toplam_fiyat, siparisler.tarih FROM siparisler INNER JOIN urunler ON siparisler.urun_id = urunler.urun_id WHERE siparisler.kullanici_id = ? AND siparisler.urun_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $kullanici_id, $siparis_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: invoice.php");
    exit;
}

$siparis = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Düzenle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Sipariş Düzenle</h2>
    <form action="edit_order_process.php" method="post">
        <input type="hidden" name="siparis_id" value="<?php echo $siparis['urun_id']; ?>">
        <div class="form-group">
            <label for="urun_adi">Ürün Adı</label>
            <input type="text" class="form-control" id="urun_adi" value="<?php echo $siparis['isim']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="adet">Adet</label>
            <input type="number" class="form-control" id="adet" name="adet" value="<?php echo $siparis['adet']; ?>" required>
        </div>
        <div class="form-group">
            <label for="toplam_fiyat">Toplam Fiyat</label>
            <input type="number" class="form-control" id="toplam_fiyat" value="<?php echo $siparis['toplam_fiyat']; ?>" disabled>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$siparis_id = $_GET['id'];

$query = "SELECT siparisler.urun_id, urunler.isim, siparisler.adet, siparisler.toplam_fiyat, siparisler.tarih FROM siparisler INNER JOIN urunler ON siparisler.urun_id = urunler.urun_id WHERE siparisler.kullanici_id = ? AND siparisler.urun_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $kullanici_id, $siparis_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: invoice.php");
    exit;
}

$siparis = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Düzenle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Sipariş Düzenle</h2>
    <form action="edit_order_process.php" method="post">
        <input type="hidden" name="siparis_id" value="<?php echo $siparis['urun_id']; ?>">
        <div class="form-group">
            <label for="urun_adi">Ürün Adı</label>
            <input type="text" class="form-control" id="urun_adi" value="<?php echo $siparis['isim']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="adet">Adet</label>
            <input type="number" class="form-control" id="adet" name="adet" value="<?php echo $siparis['adet']; ?>" required>
        </div>
        <div class="form-group">
            <label for="toplam_fiyat">Toplam Fiyat</label>
            <input type="number" class="form-control" id="toplam_fiyat" value="<?php echo $siparis['toplam_fiyat']; ?>" disabled>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
