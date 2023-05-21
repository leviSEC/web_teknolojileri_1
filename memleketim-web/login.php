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

    // Kullanıcı adını kontrol et
    if (!strpos($username, '@sakarya.edu.tr')) {
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
        exit(); // İşlem başarılı olduğunda scriptin devam etmesini engellemek için exit() fonksiyonunu kullanıyoruz.
    } else {
        // Başarısız login durumunda hata mesajı göster ve kullanıcıyı login sayfasına yönlendir
        $errorMessage = "Kullanıcı adı veya şifre yanlış!";
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Geçerli bir mail adresi girmelisiniz!";
        }
        echo "<p style='color:red'>$errorMessage</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        // Hata mesajını göster
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"]) || empty($_POST["password"])) {
                echo "<p style='color:red'>Kullanıcı adı ve şifre alanları boş bırakılamaz!</p>";
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
    </div>
</body>
</html>
