# Caspian Industry - Test Rehberi

## 🧪 Test Yöntemleri

### Yöntem 1: MAMP Kullanarak (macOS için en kolay)

1. **MAMP İndir ve Kur**
   - https://www.mamp.info/en/downloads/ adresinden MAMP'i indirin
   - MAMP'i kurun (ücretsiz versiyon yeterli)

2. **Projeyi MAMP'e Taşı**
   ```bash
   # Terminal'de çalıştır:
   cp -r /Users/nurxanmasimzade/Desktop/php/caspianindustry /Applications/MAMP/htdocs/
   ```

3. **MAMP'i Başlat**
   - MAMP uygulamasını açın
   - "Start Servers" butonuna tıklayın
   - Apache ve MySQL başlayacak

4. **Tarayıcıda Aç**
   - http://localhost:8888/caspianindustry
   - veya
   - http://localhost/caspianindustry (port ayarlarına göre)

### Yöntem 2: Homebrew ile PHP Kurarak

```bash
# Terminal'de sırayla çalıştır:
# 1. Homebrew ile PHP kur
brew install php

# 2. PHP versiyonunu kontrol et
php -v

# 3. Proje klasörüne git
cd /Users/nurxanmasimzade/Desktop/php/caspianindustry

# 4. PHP sunucusunu başlat
php -S localhost:8000

# 5. Tarayıcıda aç: http://localhost:8000
```

### Yöntem 3: Docker Kullanarak

Eğer Docker yüklüyse:

```bash
cd /Users/nurxanmasimzade/Desktop/php/caspianindustry

# PHP-Apache Docker container başlat
docker run -d -p 8080:80 -v $(pwd):/var/www/html php:8.1-apache

# Tarayıcıda aç: http://localhost:8080
```

## ✅ Test Checklist

### Frontend Testleri

- [ ] **Ana Sayfa** (/)
  - [ ] Globe animasyonu çalışıyor mu?
  - [ ] Dil değiştirme çalışıyor mu? (EN/RU/AZ)
  - [ ] Hero section düzgün görünüyor mu?
  - [ ] Navbar scroll efekti çalışıyor mu?

- [ ] **About** (/pages/about)
  - [ ] Globe animasyonu çalışıyor mu?
  - [ ] İstatistikler görünüyor mu?
  - [ ] Responsive tasarım çalışıyor mu?

- [ ] **Contact** (/pages/contact)
  - [ ] Form gönderimi çalışıyor mu?
  - [ ] Validasyon çalışıyor mu?
  - [ ] İletişim bilgileri görünüyor mu?

- [ ] **News** (/pages/news)
  - [ ] Haber listesi görünüyor mu?
  - [ ] Detay sayfası açılıyor mu?

- [ ] **Projects** (/pages/projects)
  - [ ] Proje listesi görünüyor mu?
  - [ ] Detay sayfası açılıyor mu?

- [ ] **Gallery** (/pages/gallery)
  - [ ] Resimler görünüyor mu?
  - [ ] Lightbox çalışıyor mu?

- [ ] **Partners** (/pages/partners)
  - [ ] Partner logoları görünüyor mu?
  - [ ] Hover efektleri çalışıyor mu?

- [ ] **FAQ** (/pages/faq)
  - [ ] Accordion açılıp kapanıyor mu?

### Admin Panel Testleri

- [ ] **Login** (/admin/login.php)
  - [ ] Giriş yapılabiliyor mu? (admin/admin123)
  - [ ] Hatalı şifre kontrolü çalışıyor mu?

- [ ] **Dashboard** (/admin)
  - [ ] İstatistikler görünüyor mu?
  - [ ] Son aktiviteler listeleniyor mu?

- [ ] **Contact Forms** (/admin/contacts.php)
  - [ ] Formlar listeleniyor mu?
  - [ ] Mesaj detayı görünüyor mu?
  - [ ] Silme işlemi çalışıyor mu?

- [ ] **News Management** (/admin/news.php)
  - [ ] Yeni haber eklenebiliyor mu?
  - [ ] Resim yüklenebiliyor mu?
  - [ ] 3 dilde içerik girilebiliyor mu?
  - [ ] Düzenleme çalışıyor mu?
  - [ ] Silme çalışıyor mu?

- [ ] **Settings** (/admin/settings.php)
  - [ ] Ayarlar kaydediliyor mu?
  - [ ] İletişim bilgileri güncellenebiliyor mu?

### Responsive Testler

- [ ] **Desktop** (>1024px)
  - [ ] Tüm öğeler düzgün görünüyor
  - [ ] Grid layout'lar çalışıyor

- [ ] **Tablet** (768px - 1024px)
  - [ ] Navbar mobile menüye geçiyor
  - [ ] Grid'ler 2 sütuna düşüyor

- [ ] **Mobile** (<768px)
  - [ ] Hamburger menü çalışıyor
  - [ ] Tek sütun layout
  - [ ] Touch friendly

### Tarayıcı Testleri

- [ ] Chrome
- [ ] Safari
- [ ] Firefox
- [ ] Edge

## 🐛 Sık Karşılaşılan Sorunlar ve Çözümleri

### 1. Sayfa Görünmüyor - 404 Error

**Çözüm:**
```bash
# .htaccess dosyasının olduğundan emin olun
ls -la /Users/nurxanmasimzade/Desktop/php/caspianindustry/.htaccess

# Yoksa, proje klasöründe .htaccess var mı kontrol edin
```

### 2. CSS/JS Yüklenmiyor

**Çözüm:**
- Tarayıcı console'u açın (F12)
- Network tabını kontrol edin
- Path'lerin doğru olduğundan emin olun

### 3. Database Hatası

**Çözüm:**
```bash
# database klasörüne yazma izni verin
chmod 777 /Users/nurxanmasimzade/Desktop/php/caspianindustry/database
```

### 4. Upload Çalışmıyor

**Çözüm:**
```bash
# uploads klasörüne yazma izni verin
chmod 777 /Users/nurxanmasimzade/Desktop/php/caspianindustry/assets/uploads
```

### 5. Admin Paneline Girilemİyor

**Çözüm:**
- Kullanıcı adı: `admin`
- Şifre: `admin123`
- Tarayıcı çerezlerini temizleyin
- Private/Incognito modda deneyin

## 📱 Test İçin Örnek Data Ekleme

### Manuel Test Data (Admin Panel Üzerinden)

1. **İlk Haberi Ekleyin**
   - Admin → News → Add New
   - Başlık (EN): "Welcome to Caspian Industry"
   - Başlık (RU): "Добро пожаловать в Caspian Industry"
   - Başlık (AZ): "Caspian Industry-ə xoş gəlmisiniz"
   - İçerik yazın, tarih seçin, kaydedin

2. **İlk Projeyi Ekleyin**
   - Admin → Projects → Add New
   - Benzer şekilde 3 dilde bilgi girin

3. **Test Contact Formu**
   - Frontend'e gidin
   - Contact sayfasına gidin
   - Formu doldurun ve gönderin
   - Admin panelden mesajı kontrol edin

## 🎯 Production'a Almadan Önce

- [ ] Admin şifresini değiştir
- [ ] HTTPS'i etkinleştir (.htaccess'te)
- [ ] Error reporting'i kapat (config.php)
- [ ] Database backup al
- [ ] Test verilerini temizle
- [ ] Logo ve görselleri optimize et
- [ ] SEO meta taglerini kontrol et

## 💡 Hızlı Test Komutu

Eğer PHP kuruluysa, tek komutla test:

```bash
cd /Users/nurxanmasimzade/Desktop/php/caspianindustry && php -S localhost:8000
```

Sonra tarayıcıda: http://localhost:8000

---

**Not:** İlk açılışta database otomatik oluşturulacak, bu normal!
