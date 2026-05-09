<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Girişi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="text-center mb-4">
            <h2 class="fw-bold baslik-stili" style="margin-bottom: 1rem;">Sisteme Giriş</h2>
            <p class="text-muted">Öğrenci e-posta adresiniz ve şifrenizle giriş yapınız.</p>
        </div>

        <?php
        // Eğer giriş sayfasında bir hata parametresi varsa göster
        if (isset($_GET['hata']) && $_GET['hata'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                    E-posta veya şifre hatalı! Lütfen bilgilerinizi kontrol ediniz.
                  </div>';
        }
        ?>

        <form id="loginForm" action="login_islem.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Öğrenci E-posta</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="B251210555@gmail.com">
                <div id="emailHata" class="text-danger small mt-1" style="display: none;"></div>
            </div>

            <div class="mb-4">
                <label for="sifre" class="form-label fw-semibold">Şifre (Öğrenci No)</label>
                <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifrenizi giriniz">
                <div id="sifreHata" class="text-danger small mt-1" style="display: none;"></div>
            </div>

            <div class="d-grid gap-2">
                <button type="button" onclick="loginKontrol()" class="btn btn-primary py-2">Giriş Yap</button>
                <a href="index.html" class="btn btn-outline-secondary py-2">Ana Sayfaya Dön</a>
            </div>
        </form>
    </div>
</div>

<script>
function loginKontrol() {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const sifreInput = document.getElementById('sifre');
    const emailHata = document.getElementById('emailHata');
    const sifreHata = document.getElementById('sifreHata');
    
    let gecerli = true;

    // Hata mesajlarını sıfırla
    emailHata.style.display = 'none';
    sifreHata.style.display = 'none';

    const email = emailInput.value.trim();
    const sifre = sifreInput.value.trim();

    // Boş alan kontrolü
    if (email === "") {
        emailHata.textContent = "E-posta alanı boş bırakılamaz.";
        emailHata.style.display = 'block';
        gecerli = false;
    } else {
        // Mail format kontrolü
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailHata.textContent = "Lütfen geçerli bir e-posta adresi giriniz.";
            emailHata.style.display = 'block';
            gecerli = false;
        }
    }

    // Şifre boşluk kontrolü
    if (sifre === "") {
        sifreHata.textContent = "Şifre alanı boş bırakılamaz.";
        sifreHata.style.display = 'block';
        gecerli = false;
    }

    if (gecerli) {
        form.submit();
    }
}
</script>

</body>
</html>
