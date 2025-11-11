# Caspian Industry Web Sitesi - Kurulum ve Kullanım Kılavuzu

## 📋 Proje Özeti

Caspian Industry için tamamen PHP ile yazılmış, 3 dilli (İngilizce, Rusça, Azerbaycan), dark theme'li modern bir kurumsal web sitesi.

## ✨ Özellikler

### Frontend (Kullanıcı Tarafı)
- ✅ 3 dil desteği (EN/RU/AZ)
- ✅ Responsive tasarım (mobil uyumlu)
- ✅ Dark theme (logo renk paletiyle)
- ✅ 3D dünya animasyonu (Globe.gl)
- ✅ Ana Sayfa (Home)
- ✅ Hakkımızda (About) - Globe ile
- ✅ Haberler (News) - Detay sayfalarıyla
- ✅ Projeler (Projects) - Detay sayfalarıyla
- ✅ Galeri (Gallery) - Lightbox ile
- ✅ Partnerler (Partners)
- ✅ İletişim (Contact) - Form ile
- ✅ SSS (FAQ) - Accordion ile

### Backend (Admin Paneli)
- ✅ Güvenli giriş sistemi
- ✅ Dashboard (istatistikler)
- ✅ İletişim formları yönetimi
- ✅ Haber yönetimi (CRUD)
- ✅ Proje yönetimi (CRUD)
- ✅ Galeri yönetimi (CRUD)
- ✅ Partner yönetimi (CRUD)
- ✅ SSS yönetimi (CRUD)
- ✅ Site ayarları (adres, telefon, sosyal medya)

## 🚀 Kurulum

### Gereksinimler
- PHP 7.4 veya üzeri
- Apache web sunucusu
- SQLite desteği (genelde PHP'de dahil)

### Adım Adım Kurulum

1. **Dosyaları Sunucuya Yükleyin**
   - Tüm `caspianindustry/` klasörünü web sunucunuzun root dizinine kopyalayın

2. **İzinleri Ayarlayın**
   ```bash
   chmod 777 assets/uploads
   chmod 666 database
   ```

3. **Veritabanı Otomatik Oluşur**
   - İlk erişimde SQLite veritabanı otomatik oluşturulur
   - `database/caspian_industry.db` dosyası oluşacak

4. **Admin Girişi**
   - URL: `http://siteniz.com/admin`
   - Kullanıcı adı: `admin`
   - Şifre: `admin123`
   
   ⚠️ **ÖNEMLİ**: İlk girişten sonra mutlaka şifreyi değiştirin!

### Şifre Değiştirme

`includes/config.php` dosyasını düzenleyin:
```php
define('ADMIN_PASSWORD_HASH', password_hash('yeni_sifreniz', PASSWORD_DEFAULT));
```

## 📁 Dosya Yapısı

```
caspianindustry/
├── admin/              # Admin paneli
├── assets/
│   ├── css/           # Stil dosyaları
│   ├── js/            # JavaScript
│   ├── images/        # Statik resimler (logo vs)
│   └── uploads/       # Yüklenen dosyalar
├── database/          # SQLite veritabanı
├── includes/          # PHP include dosyaları
├── languages/         # Dil dosyaları (JSON)
├── pages/            # Sayfa dosyaları
└── index.php         # Ana sayfa
```

## 🎨 Renk Paleti

Logo'dan çıkarılan renkler:
- Ana Koyu: `#0D293E`
- Ana Renk: `#205581`
- Ana Açık: `#3F6C96`
- İkincil: `#6BA8D6`
- Vurgu: `#A0BBD0`

## 📝 Admin Paneli Kullanımı

### İçerik Ekleme

1. **Haber Eklemek**
   - Admin → News → Add New
   - 3 dilde başlık ve içerik girin
   - Görsel yükleyin (opsiyonel)
   - Yayın tarihini seçin
   - "Publish this article" işaretleyin
   - Save

2. **Proje Eklemek**
   - Admin → Projects → Add New
   - Benzer şekilde 3 dilde bilgi girin
   - Müşteri, lokasyon, tamamlanma tarihi ekleyin
   - Görseller yükleyin
   - Save

3. **Partner Eklemek**
   - Admin → Partners → Add New
   - Partner adı ve logosu
   - Website URL (opsiyonel)
   - Save

4. **SSS Eklemek**
   - Admin → FAQ → Add New
   - 3 dilde soru ve cevap
   - Save

5. **Site Ayarları**
   - Admin → Settings
   - İletişim bilgilerini güncelleyin
   - Sosyal medya linklerini ekleyin
   - Save

### İletişim Formları

- Admin → Contact Forms
- Gelen mesajları görüntüleyin
- Mesaj detayını görmek için göz ikonuna tıklayın
- "Okundu" olarak işaretleyin
- Gereksiz mesajları silin

## 🌐 Dil Yönetimi

### Dil Dosyaları
- `languages/en.json` - İngilizce
- `languages/ru.json` - Rusça
- `languages/az.json` - Azerbaycan

### Çeviri Eklemek
JSON dosyalarına yeni anahtar-değer çifti ekleyin:
```json
{
  "yeni_anahtar": "Çeviri metni"
}
```

PHP'de kullanın:
```php
<?php echo t('yeni_anahtar'); ?>
```

## 🔒 Güvenlik

1. **Şifre Güvenliği**
   - Varsayılan admin şifresini değiştirin
   - Güçlü şifre kullanın

2. **Dosya İzinleri**
   - `uploads/` klasörü: 777
   - `database/` klasörü: 666
   - Diğer dosyalar: 644

3. **HTTPS**
   - Canlıya alırken `.htaccess`'te HTTPS yönlendirmesini aktifleştirin
   - SSL sertifikası yükleyin

## 🎯 Özelleştirme

### Renkleri Değiştirmek
`assets/css/style.css` içinde CSS değişkenlerini düzenleyin:
```css
:root {
    --color-primary: #205581;
    --color-secondary: #6BA8D6;
}
```

### Globe Lokasyonları
`index.php` ve `pages/about.php` içinde:
```javascript
const locations = [
    { lat: 40.4093, lng: 49.8671, name: 'BAKU' },
    // Yeni lokasyonlar ekleyin
];
```

## 📊 Veritabanı Tablolar

- `contacts` - İletişim form mesajları
- `news` - Haberler (3 dilde)
- `projects` - Projeler (3 dilde)
- `gallery` - Galeri resimleri
- `partners` - Partnerler
- `faq` - SSS (3 dilde)
- `site_settings` - Site ayarları

## 🐛 Sorun Giderme

### Sayfa Görünmüyor
- `.htaccess` dosyasının yüklendiğinden emin olun
- Apache'de `mod_rewrite` modülünün aktif olduğunu kontrol edin

### Resimler Yüklenmiyor
- `assets/uploads/` klasörünün yazma iznini kontrol edin
- PHP upload limitlerini kontrol edin (`upload_max_filesize`, `post_max_size`)

### Admin Paneline Girilemİyor
- Doğru kullanıcı adı ve şifre: `admin` / `admin123`
- Session çalışıyormu kontrol edin
- Browser çerezlerini temizleyin

## 📞 Destek

Sorularınız için: info@caspianindustry.com

## 🎉 Tamamlandı!

Web siteniz hazır! Şimdi:
1. ✅ Admin paneline giriş yapın
2. ✅ Şifrenizi değiştirin
3. ✅ Site ayarlarını güncelleyin
4. ✅ İlk içeriğinizi ekleyin
5. ✅ Test edin
6. ✅ Canlıya alın!

---

**Built for Caspian Industry** 🏭
