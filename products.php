<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id']; // Kullanıcı adı olarak kullanıcı ID'sini kullanıyoruz.

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
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <h2 class="mt-5">Ürünler</h2>
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="product.php" class="btn btn-primary">Ürün Düzenleme</a>
        </div>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['isim']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['aciklama']); ?></p>
                    <p class="card-text">Fiyat: <?php echo htmlspecialchars($row['fiyat']); ?> TL</p>
                    <form action="cart_process.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['urun_id']); ?>">
                        <button type="submit" class="btn btn-primary" name="action" value="add">Sepete Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
