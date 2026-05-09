<?php
// login_islem.php - Login denetiminin yapıldığı PHP sayfası

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? "");
    $sifre = trim($_POST["sifre"] ?? "");

    if (empty($email) || empty($sifre) || $email !== $sifre . "@sakarya.edu.tr") {
        header("Location: login.html?hata=1");
        exit();
    }

    // Başarılı giriş
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Başarılı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="4;url=index.html">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="text-success display-1"><i class="bi bi-check-circle-fill">✓</i></h1>
        <h2 class="mb-4">Giriş Başarılı</h2>
        <div class="alert alert-success fs-4 px-5 py-3 shadow-sm">Hoşgeldiniz <strong><?= htmlspecialchars($sifre) ?></strong></div>
        <p class="text-muted mt-3">Otomatik olarak ana sayfaya yönlendiriliyorsunuz...</p>
        <a href="index.html" class="btn btn-primary mt-2">Hemen Git</a>
    </div>
</body>
</html>
<?php
} else {
    header("Location: login.html");
    exit();
}
?>
