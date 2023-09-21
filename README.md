## Sistem Point Of Sale (POS)

Sistem Point of Sale (POS), atau sering disebut juga sebagai kasir elektronik, adalah sistem perangkat keras dan perangkat lunak yang digunakan dalam bisnis ritel atau restoran untuk memproses transaksi penjualan. Tujuan utama dari sistem POS adalah untuk memungkinkan bisnis untuk mengotomatisasi dan melacak proses penjualan dan pembayaran dengan efisien.

## Persyaratan Sistem

-   Xampp (PHP versi 7.4)
-   Composer
-   Git

## Panduan Instalasi

-   Buka Aplikasi gitbash/terminal, kemudian ketikan cd c://xampp/htdocs (untuk lokasi htdocs bisa kalian sesuaikan, secara default akan di simpan di localdisk C
-   Ketikan git clone https://github.com/agungkusaeri9/point-of-sale.git pointofsale
-   Kemudian ketikan lagi cd pointofsale, maka direktori yang di htdocs tadi akan berpindah ke folder project pointofsale
-   Setelah itu ketikan composer install, dan tunggu proses instalasi paket-paket nya
-   Setelah instalasi selesai buka text editor, saya rekomendasikan pakai visual studio code atau sublime text
-   copy file .env.example dan rename menjadi .env
-   ubah APP_URL menjadi APP_URL=http://localhost:8000
-   DB_DATABASE=pointofsale
    DB_USERNAME=root
    DB_PASSWORD=
-   Kemudian buka lagi gitbash nya, dan ketikan php artisan key:generate
-   Ketikan lagi php artisan storage:link
-   Setelah itu buka xampp, klik start untuk apache dan mysqlnya
-   Selanjutnya buka browser (google chrome) dan ketika localhost/phpmyadmin
-   Buat database dengan nama pointofsale, kemudian import databasenya
-   Jika sudah selesai, buka lagi gitbash/terminalnya dan ketikan php artisan serve (perintah ini dilakukan ketika kamu ingin membuka sistem point of sale nya)
-   Selanjutnya buka web browser (google chrome) dan ketikan localhost:8000
-   Jika menampilkan halaman login, artinya sistem berhasil di install di komputer/laptop kamu

## Akun Login

-   Email : admin@gmail.com
-   Pass : admin
