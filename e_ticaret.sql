CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    isim VARCHAR(255) NOT NULL,
    kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    kullanici_adi VARCHAR(255) NOT NULL,
    sifre VARCHAR(255) NOT NULL
);
CREATE TABLE urunler (
    urun_id INT AUTO_INCREMENT PRIMARY KEY,
    aciklama TEXT NULL,
    eklenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fiyat DECIMAL(10, 2) NOT NULL,
    isim VARCHAR(255) NOT NULL,
    stok INT NOT NULL
);
CREATE TABLE sepet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    kullanici_id INT NULL,
    urun_id INT NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
);
CREATE TABLE siparisler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    kullanici_id INT NULL,
    siparis_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    toplam_fiyat DECIMAL(10, 2) NULL,
    toplam_tutar DECIMAL(10, 2) NULL,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
);
CREATE TABLE fatura (
    fatura_id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
);
CREATE TABLE fatura_detaylari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adet INT NULL,
    birim_fiyat DECIMAL(10, 2) NULL,
    fatura_id INT NULL,
    urun_id INT NULL,
    FOREIGN KEY (fatura_id) REFERENCES fatura(fatura_id),
    FOREIGN KEY (urun_id) REFERENCES urunler(urun_id)
);