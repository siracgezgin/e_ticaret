<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

// Ürünleri veritabanından al
$query = "SELECT * FROM urunler";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Ürünler</h2>
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="add_product.php" class="btn btn-success">Yeni Ürün Ekle</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Açıklama</th>
                    <th>Fiyat (TL)</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['isim']); ?></td>
                    <td><?php echo htmlspecialchars($row['aciklama']); ?></td>
                    <td><?php echo htmlspecialchars($row['fiyat']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['urun_id']; ?>" class="btn btn-primary">Düzenle</a>
                        <a href="delete_product.php?id=<?php echo $row['urun_id']; ?>" class="btn btn-danger">Sil</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
