<?php
session_start();
session_unset();
session_destroy();

// Çerezleri sıfırla
setcookie("PHPSESSID", "", time() - 3600, "/");

// Oturum sonlandırıldıktan sonra giriş sayfasına yönlendirme
header("Location: login.php");
exit;
?>
