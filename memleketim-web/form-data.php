<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Verileri</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Form Verileri</h1>
  </header>

  <main>
    <h2>Gönderilen Form Verileri:</h2>
    <p>İsim: <?php echo $_GET['name']; ?></p>
    <p>E-posta: <?php echo $_GET['email']; ?></p>
    <p>Mesaj: <?php echo $_GET['message']; ?></p>
  </main>
</body>

</html>