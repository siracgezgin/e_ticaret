# E-Ticaret Projesi

Bu proje, bir e-ticaret web uygulamasının temel özelliklerini içerir. Kullanıcılar, ürünleri görüntüleyebilir, sepete ekleyebilir, sipariş verebilir , ürün ekleyebilir-silebilirler ve hesaplarını yönetebilirler.

## Özellikler

- **Ürün İşlemleri:** Kullanıcılar, ürünleri görüntüleyebilir, detaylarını inceleyebilir, sepete ekleyebilir ve sipariş verebilirler. Yöneticiler, ürünleri ekleyebilir, düzenleyebilir ve silebilirler.
- **Kullanıcı Yönetimi:** Kullanıcılar, hesaplarını oluşturabilir, oturum açabilir ve sipariş geçmişlerini görüntüleyebilirler.
- **Sipariş Yönetimi:** Kullanıcılar, sipariş durumlarını takip edebilir ve geçmiş siparişlerini görüntüleyebilirler.
- **Faturalandırma:** Faturalandırma sistemi, kullanıcıların siparişlerini takip etmelerini ve faturaları görüntülemelerini sağlar.

## Kurulum

1. Bu depoyu klonlayın:

    ```bash
    git clone https://github.com/siracgezgin/e_ticaret.git
    ```

2. `e_ticaret` dizinine gidin:

    ```bash
    cd e_ticaret
    ```

3. Veritabanını oluşturmak için MySQL komutlarını kullanın:

    ```sql
    CREATE DATABASE e_ticaret;
    USE e_ticaret;
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

    ```

4. Projeyi çalıştırmak için XAMPP, WAMP veya benzeri bir sunucu yazılımını kullanın. PHP ve MySQL'i etkinleştirmeyi unutmayın.

5. Web tarayıcınızı açın ve `http://localhost/e_ticaret` adresine gidin.

## Kullanılan Teknolojiler

- **Sunucu Dili:** PHP
- **Veritabanı:** MySQL
- **Web Teknolojileri:** HTML, CSS, JavaScript
- **Framework:** Bootstrap

## Katkılar

Bu proje açık kaynaklıdır ve katkılara her zaman açıktır. Herhangi bir hata bulursanız veya bir öneriniz varsa, lütfen bir sorun oluşturun veya bir çekme isteği gönderin.

## Lisans

Bu proje MIT Lisansı altında lisanslanmıştır. Daha fazla bilgi için [LICENSE](LICENSE) dosyasına bakın.
