<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı ve şifreyi al
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adı ve şifrenin boş olup olmadığını kontrol et
    if (empty($username) || empty($password)) {
        $_SESSION["error"] = "Kullanıcı adı ve şifre alanları boş bırakılamaz!";
        header("Location: login.php");
        exit;
    }

    // Kullanıcı adının bir e-posta adresi olup olmadığını kontrol et
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Geçerli bir e-posta adresi girmelisiniz!";
        header("Location: login.php");
        exit;
    }

    // Kullanıcının veritabanında doğruluğunu kontrol et
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if ($password === $storedPassword) {
            $_SESSION["success"] = "Hoşgeldiniz: " . $username;
            header("Location: welcome.php");
            exit;
        }
    }

    $_SESSION["error"] = "Kullanıcı adı veya şifre hatalı!";
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sayfası</title>
</head>
<body>
    <h1>Login Sayfası</h1>
    <?php
    // Hata mesajını göster (varsa)
    if (isset($_SESSION["error"])) {
        echo "<p style='color: red'>" . $_SESSION["error"] . "</p>";
        unset($_SESSION["error"]);
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Giriş Yap">
    </form>
</body>
</html>