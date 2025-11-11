# 🚀 Caspian Industry - Hızlı Başlangıç

## 📍 Proje Konumu

```
/Applications/MAMP/htdocs/caspianindustry
```

## 🌐 URL'ler

### Frontend (Ziyaretçi Sayfaları)

```
Ana Sayfa:     http://localhost:8888/caspianindustry/
Hakkımızda:    http://localhost:8888/caspianindustry/pages/about.php
Haberler:      http://localhost:8888/caspianindustry/pages/news.php
Projeler:      http://localhost:8888/caspianindustry/pages/projects.php
Galeri:        http://localhost:8888/caspianindustry/pages/gallery.php
Partnerler:    http://localhost:8888/caspianindustry/pages/partners.php
İletişim:      http://localhost:8888/caspianindustry/pages/contact.php
SSS:           http://localhost:8888/caspianindustry/pages/faq.php
```

### Admin Panel

```
Login:         http://localhost:8888/caspianindustry/admin/login.php
Dashboard:     http://localhost:8888/caspianindustry/admin/
Haberler:      http://localhost:8888/caspianindustry/admin/news.php
Projeler:      http://localhost:8888/caspianindustry/admin/projects.php
Galeri:        http://localhost:8888/caspianindustry/admin/gallery.php
Partnerler:    http://localhost:8888/caspianindustry/admin/partners.php
SSS:           http://localhost:8888/caspianindustry/admin/faq.php
İletişim:      http://localhost:8888/caspianindustry/admin/contacts.php
Ayarlar:       http://localhost:8888/caspianindustry/admin/settings.php
```

## 🔐 Admin Giriş Bilgileri

```
Kullanıcı Adı: admin
Şifre:          admin123
```

⚠️ **ÖNEMLİ:** Production'da mutlaka değiştirin!

## 📊 Mevcut İçerikler

```
✅ 9 Haber Makalesi
✅ 10 Proje
✅ 24 Partner
✅ 13 SSS
✅ 6 Galeri Öğesi
```

## 🎨 Özellikler

- 🌍 3 Dil (İngilizce, Rusça, Azerbaycan)
- 🌙 Dark Theme
- 📱 Responsive (Mobil Uyumlu)
- 🌐 3D Globe Animasyonu
- 🔒 Güvenli Admin Paneli
- 📝 İçerik Yönetim Sistemi

## ⚡ Hızlı Testler

### 1. Frontend Test

```bash
# Tarayıcıda aç:
http://localhost:8888/caspianindustry/

# Kontrol et:
✓ Globe animasyonu çalışıyor mu?
✓ Dil değiştirme (EN/RU/AZ) çalışıyor mu?
✓ Haberler görünüyor mu?
✓ Navbar scroll efekti var mı?
```

### 2. Admin Test

```bash
# Tarayıcıda aç:
http://localhost:8888/caspianindustry/admin/

# Giriş bilgileri:
admin / admin123

# Kontrol et:
✓ Dashboard istatistikleri doğru mu?
✓ Haber listesi görünüyor mu?
✓ Proje yönetimi çalışıyor mu?
```

## 🛠️ Geliştirme Komutları

### Database Yedekleme

```bash
cp /Applications/MAMP/htdocs/caspianindustry/database/caspian_industry.db \
   /Applications/MAMP/htdocs/caspianindustry/database/backup_$(date +%Y%m%d).db
```

### Database İçeriğini Görüntüleme

```bash
sqlite3 /Applications/MAMP/htdocs/caspianindustry/database/caspian_industry.db

# SQLite içinde:
.tables                          # Tabloları listele
SELECT COUNT(*) FROM news;       # Haber sayısı
SELECT COUNT(*) FROM projects;   # Proje sayısı
.exit                            # Çık
```

### Log Kontrolü

```bash
# Apache error log
tail -f /Applications/MAMP/logs/apache_error.log

# PHP error log
tail -f /Applications/MAMP/logs/php_error.log
```

## 📁 Önemli Dosyalar

### Konfigürasyon

```
includes/config.php      # Ana konfigürasyon
includes/database.php    # Database bağlantısı
includes/language.php    # Dil sistemi
.htaccess               # Apache ayarları
```

### Stil ve Script

```
assets/css/style.css    # Frontend stilleri
assets/css/admin.css    # Admin panel stilleri
assets/js/main.js       # Frontend JavaScript
assets/js/admin.js      # Admin JavaScript
```

### Veritabanı

```
database/caspian_industry.db        # Ana veritabanı
database/add_sample_content.sql     # Örnek veriler
```

## 🎯 Sık Kullanılan İşlemler

### Yeni Haber Eklemek

1. Admin'e giriş yap
2. News → Add New
3. 3 dilde başlık ve içerik gir
4. Resim yükle (opsiyonel)
5. "Publish this article" işaretle
6. Save

### Yeni Proje Eklemek

1. Admin'e giriş yap
2. Projects → Add New
3. 3 dilde bilgi gir
4. Müşteri, lokasyon, tarih ekle
5. Resimler yükle
6. Save

### Site Ayarlarını Güncelleme

1. Admin'e giriş yap
2. Settings
3. İletişim bilgilerini güncelle
4. Sosyal medya linklerini ekle
5. Save Changes

## 🐛 Sorun Giderme

### Sayfa 404 Hatası

```bash
# .htaccess dosyasını kontrol et
ls -la /Applications/MAMP/htdocs/caspianindustry/.htaccess

# Apache mod_rewrite aktif mi kontrol et
# MAMP → Preferences → Apache → Modules
```

### Resim Yüklenmiyor

```bash
# uploads dizini iznini kontrol et
ls -la /Applications/MAMP/htdocs/caspianindustry/assets/uploads/

# İzin ver
chmod 777 /Applications/MAMP/htdocs/caspianindustry/assets/uploads/
```

### Database Hatası

```bash
# Database dosyası var mı?
ls -la /Applications/MAMP/htdocs/caspianindustry/database/

# İzin var mı?
chmod 666 /Applications/MAMP/htdocs/caspianindustry/database/caspian_industry.db
```

### Admin Girişi Çalışmıyor

```bash
# Session çalışıyor mu kontrol et
# Browser'da çerezleri temizle
# Private/Incognito modda dene

# Şifreyi sıfırla
# includes/config.php dosyasını düzenle:
# define('ADMIN_PASSWORD_HASH', password_hash('yeni_sifre', PASSWORD_DEFAULT));
```

## 📞 Destek

Sorun yaşarsanız:

1. `DURUM.md` dosyasını okuyun
2. `TEST.md` dosyasındaki testleri yapın
3. Error logları kontrol edin

## 🎉 Başarılar!

Projeniz çalışıyor ve kullanıma hazır! 🚀

---

**Son Güncelleme:** 11 Kasım 2024
