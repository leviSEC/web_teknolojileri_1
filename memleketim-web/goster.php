<!DOCTYPE html>
<html>
<head>
    <title>Form Sonuçları</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $occupation = $_POST['occupation'];
        $communicationChannels = $_POST['communicationChannels'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $file = $_FILES['file']['name'];
        $date = $_POST['date'];
        $country = $_POST['country'];
        $languages = $_POST['languages'];

        echo "<h1>Form Sonuçları</h1>";
        echo "<p><strong>Ad:</strong> $name</p>";
        echo "<p><strong>E-posta:</strong> $email</p>";
        echo "<p><strong>Telefon:</strong> $phone</p>";
        echo "<p><strong>Cinsiyet:</strong> $gender</p>";
        echo "<p><strong>Yaş:</strong> $age</p>";
        echo "<p><strong>Meslek:</strong> $occupation</p>";
        echo "<p><strong>İletişim Kanalı:</strong> " . implode(", ", $communicationChannels) . "</p>";
        echo "<p><strong>Konu:</strong> $subject</p>";
        echo "<p><strong>Mesaj:</strong> $message</p>";
        echo "<p><strong>Dosya:</strong> $file</p>";
        echo "<p><strong>Tarih:</strong> $date</p>";
        echo "<p><strong>Ülke:</strong> $country</p>";
        echo "<p><strong>Diller:</strong> " . implode(", ", $languages) . "</p>";
    } else {
        echo "<p>Form verisi gönderilmedi.</p>";
    }
    ?>
</body>
</html>