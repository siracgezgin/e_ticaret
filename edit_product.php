<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: product.php");
    exit;
}

$urun_id = $_GET['id'];

// Seçilen ürünü veritabanından al
$query = "SELECT * FROM urunler WHERE urun_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $urun_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Belirtilen ID ile ürün bulunamadı
    header("Location: product.php");
    exit;
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Düzenleme formu gönderildiğinde

    // Yeni bilgileri al
    $isim = $_POST['isim'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];

    // Veritabanında güncelleme yap
    $update_query = "UPDATE urunler SET isim = ?, aciklama = ?, fiyat = ? WHERE urun_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssdi", $isim, $aciklama, $fiyat, $urun_id);
    $update_stmt->execute();

    // Ürün güncellendi, product.php sayfasına yönlendir
    header("Location: product.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Düzenleme</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Ürün Düzenleme</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="isim">Ürün Adı</label>
            <input type="text" class="form-control" id="isim" name="isim" value="<?php echo $row['isim']; ?>" required>
        </div>
        <div class="form-group">
            <label for="aciklama">Açıklama</label>
            <textarea class="form-control" id="aciklama" name="aciklama" rows="3" required><?php echo $row['aciklama']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="fiyat">Fiyat (TL)</label>
            <input type="number" class="form-control" id="fiyat" name="fiyat" value="<?php echo $row['fiyat']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Kaydet</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
