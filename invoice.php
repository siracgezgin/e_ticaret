<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];

$query = "SELECT fatura.*, urunler.isim, urunler.fiyat FROM fatura INNER JOIN urunler ON fatura.urun_id = urunler.urun_id WHERE fatura.kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice-card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }
        .invoice-card h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .invoice-card table {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice-card table th, .invoice-card table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .invoice-card table th {
            background-color: #f8f8f8;
        }
        .invoice-card .total {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include 'navbar_logged_in.php'; ?>

<div class="container">
    <div class="invoice-card mt-5">
        <h2>Fatura</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Fiyat</th>
                    <th>Tarih</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_price = 0; // Toplam fiyatı hesaplamak için değişken
                while ($row = $result->fetch_assoc()): 
                    $total_price += $row['fiyat'] * $row['adet']; // Her ürünün fiyatını toplam fiyata ekle
                ?>
                    <tr>
                        <td><?php echo $row['isim']; ?></td>
                        <td><?php echo $row['adet']; ?></td>
                        <td><?php echo $row['fiyat']; ?> TL</td>
                        <td><?php echo $row['tarih']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="text-right total">
            Toplam: <?php echo $total_price; ?> TL
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
