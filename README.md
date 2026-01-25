# Sistem Informasi Perpustakaan Kota

Aplikasi web untuk mengelola sistem perpustakaan kota yang mencakup manajemen buku, anggota, peminjaman, booking, dan denda.

## Teknologi yang Digunakan

- **Laravel 12** - PHP Framework
- **PHP 8.2+** - Backend
- **MySQL** - Database
- **Bootstrap 5** - UI Framework
- **Vite** - Asset Bundling

## Cara Menjalankan

1. Clone repository dan install dependencies:
```bash
composer install
npm install
```

2. Setup environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Konfigurasi database di file `.env`, lalu jalankan migrasi:
```bash
php artisan migrate
```

4. Jalankan aplikasi:
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

## Role yang Tersedia

### 1. Admin
- Akses penuh ke semua fitur
- Kelola anggota, buku, peminjaman, booking, denda, dan users

### 2. Staff
- Kelola anggota
- Kelola peminjaman
- Kelola denda

### 3. Staff Stock
- Kelola buku (stok perpustakaan)

### 4. Anggota
- Booking buku
- Lihat riwayat peminjaman
- Lihat denda

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
