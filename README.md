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

Veritabanı yapısı şu şekildedir:

#### Kullanıcılar Tablosu

```sql
CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    isim VARCHAR(255) NOT NULL,
    kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    kullanici_adi VARCHAR(255) NOT NULL,
    sifre VARCHAR(255) NOT NULL
);
```

#### Ürünler Tablosu

```sql
CREATE TABLE urunler (
    urun_id INT AUTO_INCREMENT PRIMARY KEY,
    aciklama TEXT NULL,
    eklenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fiyat DECIMAL(10, 2) NOT NULL,
    isim VARCHAR(255) NOT NULL,
    stok INT NOT NULL
);
```

#### Sepet Tablosu

```sql
CREATE TABLE sepet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    kullanici_id INT NULL,
    urun_id INT NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
);
```

#### Siparişler Tablosu

```sql
CREATE TABLE siparisler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    kullanici_id INT NULL,
    siparis_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    toplam_fiyat DECIMAL(10, 2) NULL,
    toplam_tutar DECIMAL(10, 2) NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
);
```

#### Fatura Tablosu

```sql
CREATE TABLE fatura (
    fatura_id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
);
```

#### Fatura Detayları Tablosu

```sql
CREATE TABLE fatura_detaylari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    birim_fiyat DECIMAL(10, 2) NULL,
    fatura_id INT NULL,
    urun_id INT NULL,
    FOREIGN KEY (fatura_id) REFERENCES fatura(fatura_id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
);
```

### 5. Veritabanı Bağlantısının Ayarlanması

Projeyi klonladığınız dizindeki `includes` veya `config` klasörüne gidin.

`db.php` veya `config.php` gibi bir dosyayı açın ve veritabanı bağlantı bilgilerinizi güncelleyin. Örnek bağlantı bilgileri:

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
