<style>
    .navbar-brand {
        position: relative;
        color: #113e68;
        font-weight: bold;
        font-size: 24px;
    }

    .navbar-brand::after {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        background-color: transparent;
        border: 2px solid #50b1c8; /* Değiştirilen renk */
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

    .navbar-nav {
        align-items: center;
    }

    .nav-link {
        color: #113e68; /* Değiştirilen renk */
        font-weight: bold;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #50b1c8; /* Değiştirilen renk */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f8f9fa;"> <!-- Arka plan rengi değiştirildi -->
    <a class="navbar-brand animated fadeInLeft" href="index.php">GezginCe®</a>
    <button class="navbar-toggler animated fadeInRight" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item animated fadeInDown">
                <a class="nav-link hover-effect" href="login.php">Giriş Yap</a>
            </li>
            <li class="nav-item animated fadeInDown">
                <a class="nav-link hover-effect" href="register.php">Üye Ol</a>
            </li>
        </ul>
    </div>
</nav>
