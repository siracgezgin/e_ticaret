<?php
session_start();
include 'db.php';

if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isim = $_POST['isim'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $sifre_tekrar = $_POST['sifre_tekrar'];

    if ($sifre != $sifre_tekrar) {
        $error = 'Şifreler eşleşmiyor.';
    } else {
        $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);

        $query = "SELECT * FROM kullanicilar WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Bu email adresi ile kayıtlı bir kullanıcı zaten var.';
        } else {
            $insert_stmt = $conn->prepare("INSERT INTO kullanicilar (email, sifre, isim) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $email, $hashed_password, $isim);
            $insert_stmt->execute();
            $_SESSION['success'] = "Kayıt başarılı. Lütfen giriş yapın.";
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2 class="mt-5">Kayıt Ol</h2>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="isim">İsim</label>
            <input type="text" class="form-control" id="isim" name="isim" required>
        </div>
        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="sifre">Şifre</label>
            <input type="password" class="form-control" id="sifre" name="sifre" required>
        </div>
        <div class="form-group">
            <label for="sifre_tekrar">Şifre Tekrar</label>
            <input type="password" class="form-control" id="sifre_tekrar" name="sifre_tekrar" required>
        </div>
        <button type="submit" class="btn btn-primary">Kayıt Ol</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
