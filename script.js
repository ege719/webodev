document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('apiSonuc')) fetchShowsData();
    if (document.getElementById('iletisimFormu')) initVueApp();
});

//apı kısmı dizilerin cekildigi yer
async function fetchShowsData() {
    const apiSonuc = document.getElementById('apiSonuc');
    
    try {
        const response = await fetch('https://api.tvmaze.com/shows');
        const shows = await response.json();


        const topShows = shows.slice(0, 12);
        let html = '';
        
        for (const show of topShows) {
            html += `
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card w-100 api-card-efekti border border-1">
                    <img src="${show.image?.medium || 'https://via.placeholder.com/210x295?text=Gorsel+Yok'}" class="card-img-top" alt="${show.name}" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="card-title fw-bold text-dark mb-1" style="font-size: 1.1rem;">${show.name}</h6>
                        <p class="card-text text-warning small fw-bold mb-1"> Puan: ${show.rating?.average || 'Bilinmiyor'}</p>
                        <p class="card-text text-muted small mb-2"> Çıkış: ${show.premiered || 'Bilinmiyor'}</p>
                        <div class="mt-auto">
                            <p class="card-text text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.4;">${show.genres.join(', ')}</p>
                        </div>
                    </div>
                </div>
            </div>`;
        }
        apiSonuc.innerHTML = html;
    } catch (error) {
        apiSonuc.innerHTML = `
            <div class="alert alert-danger text-center" role="alert">
                Dizi verileri yüklenirken bir hata oluştu!
            </div>
        `;
    }
}

// ORTAK FORM DOĞRULAMA MANTIĞI
// iki giris icinde tekrarı engelleyen kodlar 
function getFormErrors() {
    const adSoyad = document.getElementById('adSoyad').value.trim();
    const email = document.getElementById('email').value.trim();
    const telefon = document.getElementById('telefon').value.trim();
    const konu = document.getElementById('konu').value;
    const mesaj = document.getElementById('mesaj').value.trim();
    const cinsiyetSecili = document.querySelector('input[name="cinsiyet"]:checked');
    const ilgiSecili = document.querySelectorAll('input[name="ilgi[]"]:checked');

    let hatalar = [];
    if (!adSoyad) hatalar.push("Ad Soyad alanı boş bırakılamaz.");
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) hatalar.push("E-posta alanı boş bırakılamaz.");
    else if (!emailRegex.test(email)) hatalar.push("Lütfen geçerli bir e-posta adresi giriniz.");

    const telRegex = /^[0-9]+$/;
    if (!telefon) hatalar.push("Telefon alanı boş bırakılamaz.");
    else if (!telRegex.test(telefon)) hatalar.push("Telefon numarası sadece rakamlardan oluşmalıdır.");

    if (!konu) hatalar.push("Lütfen bir konu seçiniz.");
    if (!cinsiyetSecili) hatalar.push("Lütfen cinsiyet seçiniz.");
    if (ilgiSecili.length === 0) hatalar.push("En az bir ilgi alanı seçiniz.");
    if (!mesaj) hatalar.push("Mesaj alanı boş bırakılamaz.");

    return hatalar;
}

// native javascript kontrolu
function jsFormKontrol() {
    const hatalar = getFormErrors();
    const form = document.getElementById('iletisimFormu');

    if (hatalar.length > 0) {
        alert("JavaScript Doğrulama Hatası:\n\n" + hatalar.join("\n"));
    } else {
        alert("Harika! JavaScript doğrulaması başarılı, form gönderiliyor...");
        form.submit();
    }
}

// vue.js ile form kontrolu 
function initVueApp() {
    const { createApp } = Vue;
    createApp({
        methods: {
            vueFormKontrol() {
                const hatalar = getFormErrors();
                const form = document.getElementById('iletisimFormu');

                if (hatalar.length > 0) {
                    alert("Vue.js Doğrulama Hatası:\n\n" + hatalar.join("\n"));
                } else {
                    alert("Vue.js ile doğrulama başarılı! Formunuz gönderiliyor...");
                    form.submit();
                }
            }
        }
    }).mount('#iletisimFormu');
}
