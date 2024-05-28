# Sayfanın Linki
http://sirac.lovestoblog.com/index.php

---

## E-Ticaret Projesi Kurulum Kılavuzu

Bu kılavuzda, E-Ticaret Projesi'nin nasıl kurulacağını adım adım öğreneceksiniz.

### 1. Gereksinimler

Projenin çalıştırılması için aşağıdaki bileşenlere ihtiyacınız olacak:

- XAMPP (Apache, MySQL, PHP)
- Git

### 2. XAMPP Kurulumu

[XAMPP](https://www.apachefriends.org/index.html) web sitesinden XAMPP'ı indirin ve kurulumu başlatın. İndirme ve kurulum işlemleri için sırasıyla yönergeleri takip edin.

Kurulum tamamlandıktan sonra XAMPP Kontrol Panelini açın ve Apache ile MySQL servislerini başlatın.

### 3. Projenin Kopyalanması

Terminal veya komut istemcisini açın.

Aşağıdaki komutları çalıştırarak projeyi GitHub'dan klonlayın:

```
git clone https://github.com/siracgezgin/e_ticaret.git
```

### 4. Veritabanının Oluşturulması

1. PhpMyAdmin arayüzünü açın. Tarayıcınızın adres çubuğuna `http://localhost/phpmyadmin` yazarak erişebilirsiniz.

2. Yeni bir veritabanı oluşturun ve adını `e_ticaret` olarak belirleyin.

3. Projeyi klonladığınız dizindeki `sql` veya `database` klasörüne gidin ve `e_ticaret.sql` dosyasını içe aktararak veritabanını oluşturun.

Veya veritabanı yapısı şu şekilde oluşturabilirsiniz:


```sql
-- Veritabanı oluşturulması
CREATE DATABASE e_ticaret;
USE e_ticaret;

-- kullanicilar tablosunun oluşturulması
CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    isim VARCHAR(255) NOT NULL,
    kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    kullanici_adi VARCHAR(255) NOT NULL,
    sifre VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- urunler tablosunun oluşturulması
CREATE TABLE urunler (
    urun_id INT AUTO_INCREMENT PRIMARY KEY,
    isim VARCHAR(255) NOT NULL,
    aciklama TEXT NULL,
    fiyat DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL,
    eklenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- fatura tablosunun oluşturulması
CREATE TABLE fatura (
    fatura_id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- sepet tablosunun oluşturulması
CREATE TABLE sepet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NULL,
    urun_id INT NULL,
    adet INT NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- siparisler tablosunun oluşturulması
CREATE TABLE siparisler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NULL,
    adet INT NULL,
    toplam_fiyat DECIMAL(10, 2) NULL,
    toplam_tutar DECIMAL(10, 2) NULL,
    siparis_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- fatura_detaylari tablosunun oluşturulması
CREATE TABLE fatura_detaylari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fatura_id INT NULL,
    urun_id INT NULL,
    adet INT NULL,
    birim_fiyat DECIMAL(10, 2) NULL,
    FOREIGN KEY (fatura_id) REFERENCES fatura(fatura_id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- faturalar tablosunun oluşturulması
CREATE TABLE faturalar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fatura_id INT NOT NULL,
    urun_id INT NOT NULL,
    miktar INT NOT NULL,
    birim_fiyat DECIMAL(10, 2) NOT NULL,
    toplam_fiyat DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (fatura_id) REFERENCES fatura(fatura_id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

```

### 5. Veritabanı Bağlantısının Ayarlanması

Projeyi klonladığınız dizindeki `includes` veya `config` klasörüne gidin.

`db.php` dosyasını açın ve veritabanı bağlantı bilgilerinizi güncelleyin. Örnek bağlantı bilgileri:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "e_ticaret";
```

### 6. Projeyi Çalıştırma

Web tarayıcınızı açın ve `http://localhost/e_ticaret` adresine gidin.

Artık E-Ticaret Projesi'ni kullanmaya başlayabilirsiniz!

---
![Ekran Görüntüsü (115)](https://github.com/siracgezgin/e_ticaret/assets/119105917/935be262-14b6-4d3a-a1a0-a2d17a80f81d)
![Ekran Görüntüsü (116)](https://github.com/siracgezgin/e_ticaret/assets/119105917/57eecd1b-3b06-4e7c-a253-ad9fbc401b72)
![Ekran Görüntüsü (117)](https://github.com/siracgezgin/e_ticaret/assets/119105917/8b2d518a-0b14-42a7-a0d9-8e06da66a41a)
![Ekran Görüntüsü (119)](https://github.com/siracgezgin/e_ticaret/assets/119105917/c055ea23-d8bb-426e-8652-93fbf342f1fb)
![Ekran Görüntüsü (118)](https://github.com/siracgezgin/e_ticaret/assets/119105917/0b613ab6-d0cd-4dbd-adc6-97aa098607ef)
![Ekran Görüntüsü (120)](https://github.com/siracgezgin/e_ticaret/assets/119105917/5462ed3c-7383-45d1-9eea-f3bf38b7fc57)
![Ekran Görüntüsü (121)](https://github.com/siracgezgin/e_ticaret/assets/119105917/405a221b-4a2d-436d-9ddb-078a053cb4ba)
![Ekran Görüntüsü (122)](https://github.com/siracgezgin/e_ticaret/assets/119105917/af246ef4-57ed-4a8f-bea1-ed61ec869134)
![Ekran Görüntüsü (123)](https://github.com/siracgezgin/e_ticaret/assets/119105917/88a891d8-76d8-4626-b676-b41c8b4dad29)
