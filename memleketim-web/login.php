<?php
// Kullanıcı adı ve şifre bilgilerini kontrol etmek için fonksiyon
function login($username, $password) {
    // Kullanıcı adı ve şifre alanının boş olup olmadığını kontrol et
    if (empty($username) || empty($password)) {
        return false;
    }

    // Kullanıcı adının mail adresi formatında olup olmadığını kontrol et
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Kullanıcı adından öğrenci numarasını çıkar
    $studentNumber = explode('@', $username)[0];

    // Şifreyi kontrol et
    if ($studentNumber === $password) {
        return true;
    } else {
        return false;
    }
}

// Form gönderildiğinde işlemleri yap
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı ve şifre değişkenlerini al
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Login işlemini kontrol et
    if (login($username, $password)) {
        // Başarılı login mesajını göster
        echo "Hoşgeldiniz " . htmlspecialchars($username) . "! Login işlemi başarılı.";
    } else {
        // Başarısız login durumunda kullanıcıyı login sayfasına yönlendir
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sayfası</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    // Hata mesajını göster
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            echo "<p style='color:red'>Kullanıcı adı ve şifre alanları boş bırakılamaz!</p>";
        } elseif (!filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red'>Geçerli bir mail adresi girmelisiniz!</p>";
        } elseif (strpos($_POST["username"], '@sakarya.edu.tr') === false) {
            echo "<p style='color:red'>Kullanıcı adı @sakarya.edu.tr içermelidir!</p>";
        } else {
            echo "<p style='color:red'>Kullanıcı adı veya şifre yanlış!</p>";
        }
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Şifre:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Giriş">
    </form>
</body>
</html>