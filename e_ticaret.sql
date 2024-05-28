-- Veritabanı oluşturulması ve kullanılması
CREATE DATABASE e_ticaret;
USE e_ticaret;

-- Kullanıcılar tablosunun oluşturulması
CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    isim VARCHAR(255) NOT NULL,
    kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    kullanici_adi VARCHAR(255) NOT NULL,
    sifre VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Ürünler tablosunun oluşturulması
CREATE TABLE urunler (
    urun_id INT AUTO_INCREMENT PRIMARY KEY,
    isim VARCHAR(255) NOT NULL,
    aciklama TEXT NULL,
    fiyat DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL,
    eklenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Fatura tablosunun oluşturulması
CREATE TABLE fatura (
    fatura_id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sepet tablosunun oluşturulması
CREATE TABLE sepet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NULL,
    urun_id INT NULL,
    adet INT NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Siparişler tablosunun oluşturulması
CREATE TABLE siparisler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NULL,
    adet INT NULL,
    toplam_fiyat DECIMAL(10, 2) NULL,
    toplam_tutar DECIMAL(10, 2) NULL,
    siparis_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Fatura Detayları tablosunun oluşturulması
CREATE TABLE fatura_detaylari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fatura_id INT NULL,
    urun_id INT NULL,
    adet INT NULL,
    birim_fiyat DECIMAL(10, 2) NULL,
    FOREIGN KEY (fatura_id) REFERENCES fatura(fatura_id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Faturalar tablosunun oluşturulması
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
