<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Kullanıcı adı ve şifreyi al
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Kullanıcı adının mail adresi olduğunu kontrol et
  if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.html");
    exit();
  }

  // Kullanıcı adından numarayı çıkar
  $number = substr($username, 0, strpos($username, "@"));

  // Şifreyi kontrol et
  if ($password === $number) {
    $message = "Hoşgeldiniz: " . $number;
  } else {
    header("Location: login.html");
    exit();
  }
} else {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="giris.css">
</head>

<body>
  <header>
    <h1>Login</h1>
  </header>

  <main>
    <p><?php echo $message; ?></p>
  </main>
</body>

</html>