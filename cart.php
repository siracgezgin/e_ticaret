<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$query = "SELECT sepet.id AS sepet_id, urunler.urun_id AS id, urunler.isim, urunler.fiyat, sepet.adet FROM sepet INNER JOIN urunler ON sepet.urun_id = urunler.urun_id WHERE sepet.kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();
$total_price = 0;

// Sepetin boş olup olmadığını kontrol et
$empty_cart = true;
while ($row = $result->fetch_assoc()) {
    $empty_cart = false;
    $total_price += $row['adet'] * $row['fiyat'];
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Sepet</h2>
    <?php if ($empty_cart): ?>
        <div class="alert alert-danger">Sepetinizde ürün bulunmamaktadır. Lütfen alışverişe devam edin.</div>
        <div class="text-center mt-3">
            <a href="products.php" class="btn btn-primary">Alışverişe Devam Et</a>
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Fiyat</th>
                    <th>Toplam</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php mysqli_data_seek($result, 0); // Sonraki döngü için imleci sıfırla ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['isim']; ?></td>
                        <td><?php echo $row['adet']; ?></td>
                        <td><?php echo $row['fiyat']; ?> TL</td>
                        <td><?php echo $row['adet'] * $row['fiyat']; ?> TL</td>
                        <td>
                            <form action="cart_process.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" name="action" value="remove">Sepetten Çıkar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="text-right">
            <h4>Toplam: <?php echo $total_price; ?> TL</h4>
            <form action="checkout_process.php" method="post">
                <?php if ($total_price > 0): ?>
                    <button type="submit" class="btn btn-success">Siparişi Onayla</button>
                <?php endif; ?>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
