<?php
// islem.php - Form verilerini karşılayıp ekrana yazdıran sayfa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini güvenli bir şekilde almak icin
    $adSoyad = htmlspecialchars(trim($_POST["adSoyad"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $telefon = htmlspecialchars(trim($_POST["telefon"] ?? ""));
    $konu = htmlspecialchars(trim($_POST["konu"] ?? ""));
    $cinsiyet = htmlspecialchars(trim($_POST["cinsiyet"] ?? ""));
    $mesaj = htmlspecialchars(trim($_POST["mesaj"] ?? ""));
    
    // Checkbox dizisi olduğu için kontrol edelir
    $ilgiAlanlari = isset($_POST["ilgi"]) ? $_POST["ilgi"] : [];
    $ilgiMetni = "";
    if (is_array($ilgiAlanlari)) {
        // Gelen diziyi güvenli hale getir
        $guvenliIlgi = array_map('htmlspecialchars', $ilgiAlanlari);
        $ilgiMetni = implode(", ", $guvenliIlgi);
    } else {
        $ilgiMetni = htmlspecialchars($ilgiAlanlari);
    }
} else {
    // Post isteği değilse ana sayfaya yönlendir
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Formu Sonucu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .sonuc-tablosu th {
            width: 30%;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0">Gönderilen Form Bilgileri</h3>
                </div>
                <div class="card-body p-4">
                    
                    <div class="alert alert-success" role="alert">
                        Mesajınız başarıyla alınmıştır! Aşağıda gönderdiğiniz bilgilerin bir özetini görebilirsiniz.
                    </div>

                    <table class="table table-bordered sonuc-tablosu mt-4">
                        <tbody>
                            <tr>
                                <th>Ad Soyad</th>
                                <td><?php echo $adSoyad; ?></td>
                            </tr>
                            <tr>
                                <th>E-posta</th>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <th>Telefon</th>
                                <td><?php echo $telefon; ?></td>
                            </tr>
                            <tr>
                                <th>Konu</th>
                                <td class="text-capitalize"><?php echo $konu; ?></td>
                            </tr>
                            <tr>
                                <th>Cinsiyet</th>
                                <td class="text-capitalize"><?php echo $cinsiyet; ?></td>
                            </tr>
                            <tr>
                                <th>İlgi Alanları</th>
                                <td class="text-capitalize"><?php echo empty($ilgiMetni) ? "Belirtilmedi" : $ilgiMetni; ?></td>
                            </tr>
                            <tr>
                                <th>Mesaj</th>
                                <td><?php echo nl2br($mesaj); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center mt-4">
                        <a href="index.html" class="btn btn-outline-primary px-4">Ana Sayfaya Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
