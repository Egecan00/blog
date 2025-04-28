*** Laravel ve Filament Kullanarak Blog Sitesi ***

*** Özellikler ***
--Kullanıcı kaydı ve giriş sistemi.
--Yazı oluşturma, düzenleme ve silme.
--Postlara Yorum yapabilme.
--Yazıları kategoriye göre filtreleme.
--Admin paneli yönetimi (Filament Admin ile).
--Veritabanı yönetimi için phpMyAdmin.

*** Yazar Rolüne Sahip Kullanıcılar ***
--Sadece Yazı ekleyebilecek ve düzenleyebilecek

*** Super Admin Rolüne Sahip Kullanıcılar ***
--Yazı ekleyebilecek ve düzenleyebilecek.
--Kullanıcı ekleyebilecek.
--Sitede bulunacak olan Gizlilik Politikası , KVKK sayfalarını düzenleyebilecek.
--Yapılan yorumları aktifleştirebilecek.
--Kategori ve Etiket ekleyebilecek.

*** 1.Depoyu Klonlayın ***
--git clone https://github.com/kullaniciadi/proje-adi.git 
--cd proje-adi

*** 2.Proje Env Ayarı ***
--env dosyasındaki veritabanı ayarlarının Docker konteynerindeki ayarlara uygun olduğundan emin olun.

*** 3.Cihazınızda Docker kurulu olması gerekiyor ***
--Kuruluysa başlatın:
-cd proje-adi
-docker-compose up -d
--Başarılı şekilde başlattığında:
-Laravel API'ye http://localhost:8000 adresinden ulaşabilirsin.
-Laravel Frontend'e http://localhost:8001 adresinden ulaşabilirsin.
-PhpMyAdmin'e http://localhost:8080 adresinden erişebilirsin.

*** 4.Veritabanı Migrasyonlarını Aktifleştirin ***
-cd proje-adi
-php artisan migrate

*** Filament Admin Paneli ***
-http://localhost:8000/admin adresine git.
-Giriş yapmak için önce bir kullanıcı oluştur ve ona admin yetkisi ver:
-php artisan migrate:fresh --seed
-php artisan shield:generate --all --Admin Rölünü Oluşturur

*** Kullanılan Teknolojiler ***
--PHP 8.3
--Laravel 11
--Filament Admin Panel 
--Docker
--MySQL
--phpMyAdmin
