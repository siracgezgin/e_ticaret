<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - GezginCe®</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-W8XsgLcCdZ4XmgkM3ebVlrJavjwPXe/YFpm3cMQW4Nn2dMA9XtEzFdbMyvZeNd6d9ur75ZfPYBMWe8NPRWYiCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Inline CSS -->
    <style>
        .navbar-brand {
            position: relative;
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            width: 30px; /* Çember genişliği */
            height: 30px; /* Çember yüksekliği */
            background-color: transparent;
            border: 2px solid #ff6347;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover::after {
            transform: translate(-50%, -50%) scale(2);
            opacity: 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #113e68;">
    <a class="navbar-brand" href="products.php">
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        GezginCe®
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"><?php echo $_SESSION['isim']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">
                    <i class="fas fa-shopping-cart"></i> <img src="img/icon1.png" alt="Sepet" width="20" height="20">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-njioo/mjTgNBoil2eXlBSBGblPVym5D7hV6L4s4UtrGvSUHZuk5tT9gjD7ftbpQ05brlKcF4f3Cks8L2i+IbZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
