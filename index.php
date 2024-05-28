<?php
session_start();

// Eğer kullanıcı giriş yapmışsa products.php sayfasına yönlendir
if (isset($_SESSION['kullanici_id'])) {
    header("Location: products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - GezginCe®</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">GezginCe®</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Üye Ol</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                <div class="col-md-4">
                    <img class="d-block w-100" src="img/slider1.png" alt="First slide">
                </div>
                <div class="col-md-4">
                    <img class="d-block w-100" src="img/slider2.png" alt="Second slide">
                </div>
                <div class="col-md-4">
                    <img class="d-block w-100" src="img/slider3.png" alt="Third slide">
                </div>
            </div>
        </div>
        <div class="carousel-item">
        <div class="row">
            <div class="col-md-4">
                <img class="d-block w-100" src="img/slider1.png" alt="Fourth slide">
            </div>
            <div class="col-md-4">
                <img class="d-block w-100" src="img/slider2.png" alt="Fifth slide">
            </div>
            <div class="col-md-4">
                <img class="d-block w-100" src="img/slider3.png" alt="Sixth slide">
            </div>
        </div>
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
    <span class="text-muted">FOUNDER OF SIRAC GEZGIN 
                <a href="https://github.com/siracgezgin/e_ticaret" target="_blank"><img src="img/github.png" alt="GitHub" width="30" height="30" class="social-icon"></a>
                <a href="https://www.linkedin.com/in/siracgezgin/" target="_blank"><img src="img/linkedln.png" alt="Linkedln" width="30" height="30" class="social-icon"></a>
                <a href="https://www.youtube.com/@siracgezgin" target="_blank"><img src="img/youtube.png" alt="YouTube" width="30" height="30" class="social-icon"></a>
        </span>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
