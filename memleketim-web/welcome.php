<?php
session_start();

// Eğer oturumda hoş geldiniz mesajı yoksa, kullanıcıyı login sayfasına yönlendir
if (!isset($_SESSION["success"])) {
    header("Location: login.php");
    exit;
}

// Hoş geldiniz mesajını göster ve oturumu temizle
echo "<h1>" . $_SESSION["success"] . "</h1>";
unset($_SESSION["success"]);
?>