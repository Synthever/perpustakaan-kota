# SISTEM INFORMASI PERPUSTAKAAN KOTA

Sistem informasi perpustakaan berbasis web menggunakan Laravel 12, MySQL, dan Bootstrap.

## 🚀 Fitur Utama

### Role & Akses:
1. **Administrator** - Akses penuh ke semua modul
2. **Staff** - Kelola anggota, peminjaman, pengembalian, dan denda
3. **Staff Stock** - Kelola buku dan stok
4. **Anggota** - Booking buku, lihat riwayat, dan denda

### Modul Sistem:
- ✅ CRUD Anggota (dengan auto-create user)
- ✅ CRUD Buku
- ✅ CRUD Peminjaman (multi-buku, auto kurangi stok)
- ✅ Pengembalian Buku (auto hitung denda)
- ✅ CRUD Booking
- ✅ Manajemen Denda
- ✅ CRUD User (Admin, Staff, Staff Stock)

## 📦 Instalasi

### 1. Setup Database
Buat database MySQL:
```sql
CREATE DATABASE perpustakaan_kota;
```

### 2. Konfigurasi Environment
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_kota
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Install Dependencies
```bash
composer install
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

### 6. Jalankan Server
```bash
php artisan serve
```

Akses: http://localhost:8000

## 🔐 Login Credentials

### Administrator
- Username: `admin`
- Password: `password`

### Staff Perpustakaan
- Username: `staff`
- Password: `password`

### Staff Stock
- Username: `staffstock`
- Password: `password`

### Anggota (Testing)
- Username: `budi`
- Password: `password`

- Username: `siti`
- Password: `password`

## 📊 Struktur Database

### Tabel:
1. **anggota** - Data anggota perpustakaan
2. **users** - User login (admin, staff, staff_stock, anggota)
3. **buku** - Data buku
4. **peminjaman** - Header peminjaman
5. **detail_peminjaman** - Detail buku yang dipinjam
6. **booking** - Booking buku oleh anggota
7. **denda** - Denda keterlambatan

### Relasi:
- 1 anggota → banyak peminjaman
- 1 anggota → banyak booking
- 1 peminjaman → banyak detail_peminjaman (many-to-many dengan buku)
- 1 peminjaman → 0 atau 1 denda
- 1 user → 0 atau 1 anggota (nullable untuk staff/admin)

## 💼 Logika Bisnis

### Peminjaman:
- Staff memilih anggota dan satu/lebih buku
- Sistem otomatis kurangi stok buku
- Set tanggal jatuh tempo (default +7 hari)

### Pengembalian:
- Staff input tanggal pengembalian
- Sistem kembalikan stok buku
- Jika terlambat, auto create denda (Rp 1.000/hari)

### Booking:
- Anggota bisa booking buku
- Staff/Admin approve/reject booking
- Status: Menunggu, Disetujui, Ditolak

### Denda:
- Otomatis dibuat saat pengembalian terlambat
- Perhitungan: Hari keterlambatan × Rp 1.000
- Status: Belum Dibayar / Dibayar

## 🎯 Alur Penggunaan

### Admin:
1. Login sebagai admin
2. Kelola semua data (anggota, buku, peminjaman, booking, denda, users)
3. Monitor dashboard statistik

### Staff:
1. Login sebagai staff
2. Tambah anggota baru
3. Proses peminjaman buku
4. Proses pengembalian dan hitung denda
5. Update status pembayaran denda

### Staff Stock:
1. Login sebagai staff stock
2. Kelola data buku (tambah, edit, hapus)
3. Update stok buku
4. Monitor buku dengan stok rendah

### Anggota:
1. Login sebagai anggota
2. Booking buku yang diinginkan
3. Lihat peminjaman aktif
4. Lihat denda yang belum dibayar

## 📁 Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AnggotaController.php
│   │   ├── AuthController.php
│   │   ├── BookingController.php
│   │   ├── BukuController.php
│   │   ├── DashboardController.php
│   │   ├── DendaController.php
│   │   ├── PeminjamanController.php
│   │   └── UserController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── Anggota.php
│   ├── Booking.php
│   ├── Buku.php
│   ├── Denda.php
│   ├── DetailPeminjaman.php
│   ├── Peminjaman.php
│   └── User.php
database/
├── migrations/
│   ├── 2024_01_01_000003_create_anggota_table.php
│   ├── 2024_01_01_000004_create_buku_table.php
│   ├── 2024_01_01_000005_add_role_and_id_anggota_to_users_table.php
│   ├── 2024_01_01_000006_create_peminjaman_table.php
│   ├── 2024_01_01_000007_create_detail_peminjaman_table.php
│   ├── 2024_01_01_000008_create_booking_table.php
│   └── 2024_01_01_000009_create_denda_table.php
└── seeders/
    └── DatabaseSeeder.php
resources/
└── views/
    ├── anggota/
    ├── auth/
    ├── booking/
    ├── buku/
    ├── dashboard/
    ├── denda/
    ├── layouts/
    ├── peminjaman/
    └── users/
routes/
└── web.php
```

## 🔧 Troubleshooting

### Error Migration
```bash
php artisan migrate:fresh --seed
```

### Error Autoload
```bash
composer dump-autoload
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## 📝 Catatan

- Fokus pada fungsionalitas, bukan UI
- UI menggunakan Bootstrap 5 (simple & clean)
- Denda: Rp 1.000 per hari keterlambatan
- Password default semua user: `password`
- Seeder sudah include 10 buku sample
- Middleware role-based sudah diterapkan

## ✅ Checklist Fitur

- [x] Migration sesuai struktur database
- [x] Models dengan relasi Eloquent
- [x] Authentication & Authorization
- [x] Middleware role-based
- [x] CRUD lengkap semua modul
- [x] Logika peminjaman (kurangi stok)
- [x] Logika pengembalian (hitung denda)
- [x] Booking system
- [x] Dashboard untuk tiap role
- [x] Validasi input form
- [x] Seeder untuk testing

## 🎓 Untuk UAS

Sistem ini sudah memenuhi semua requirement UAS:
1. ✅ Database sesuai ERD yang diminta
2. ✅ CRUD lengkap
3. ✅ Relasi foreign key diterapkan
4. ✅ Logika bisnis sesuai spesifikasi
5. ✅ Multi-role dengan middleware
6. ✅ Siap untuk demo dan presentasi

---

**Developed for UAS Pengolahan Basis Data**
**Laravel 12 | MySQL | Bootstrap 5**
