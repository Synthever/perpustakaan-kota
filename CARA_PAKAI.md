# 🚀 CARA MENJALANKAN APLIKASI

## Status: ✅ READY TO USE

Aplikasi **Sistem Informasi Perpustakaan Kota** sudah siap digunakan!

## Server Status
✅ Laravel Server: **RUNNING** di http://127.0.0.1:8000

## 🔑 Login Credentials

### 1. Administrator (Akses Penuh)
- URL: http://127.0.0.1:8000/login
- Username: `admin`
- Password: `password`
- Akses: Semua modul (Anggota, Buku, Peminjaman, Booking, Denda, Users)

### 2. Staff Perpustakaan
- Username: `staff`
- Password: `password`
- Akses: Anggota, Peminjaman, Pengembalian, Denda

### 3. Staff Stock
- Username: `staffstock`
- Password: `password`
- Akses: Buku (CRUD & Update Stok)

### 4. Anggota (Testing)
- Username: `budi` atau `siti`
- Password: `password`
- Akses: Booking Buku, Riwayat Peminjaman, Lihat Denda

## 📝 Alur Penggunaan Lengkap

### Scenario Demo UAS:

#### 1️⃣ Login sebagai STAFF (Kelola Peminjaman)
```
1. Login: staff / password
2. Dashboard → Menu Anggota → Tambah Anggota Baru (otomatis dapat akun login)
3. Menu Peminjaman → Tambah Peminjaman
   - Pilih Anggota: Budi Santoso
   - Tanggal Pinjam: Hari ini
   - Jatuh Tempo: +7 hari
   - Pilih Buku: Laskar Pelangi (2 buku)
   - Klik Simpan
   ✅ Stok buku otomatis berkurang!
4. Lihat daftar peminjaman aktif
```

#### 2️⃣ Login sebagai STAFF STOCK (Kelola Buku)
```
1. Login: staffstock / password
2. Dashboard → Lihat buku stok rendah
3. Menu Buku → Tambah Buku Baru
   - Judul: Buku Baru
   - Penulis: Penulis Baru
   - Penerbit: Penerbit Baru
   - Tahun: 2025
   - Stok: 10
4. Edit Buku → Update Stok
```

#### 3️⃣ Login sebagai ANGGOTA (User Experience)
```
1. Login: budi / password
2. Dashboard → Lihat Peminjaman Aktif
3. Menu Booking → Booking Buku
   - Pilih Buku: Negeri 5 Menara
   - Tanggal Booking: Hari ini
   - Klik Booking
   ✅ Status: Menunggu persetujuan
4. Lihat Denda (jika ada)
```

#### 4️⃣ Proses Pengembalian & Denda (STAFF)
```
1. Login: staff / password
2. Menu Peminjaman → Cari peminjaman aktif
3. Klik "Kembalikan" pada peminjaman
4. Input Tanggal Kembali: Lewat dari jatuh tempo
   Contoh: Jatuh tempo 01/01/2026, Kembali 05/01/2026
5. Klik "Proses Pengembalian"
   ✅ Stok buku otomatis kembali
   ✅ Denda otomatis terhitung (4 hari × Rp 1.000 = Rp 4.000)
6. Menu Denda → Lihat denda yang terbuat
7. Klik "Bayar" untuk update status pembayaran
```

#### 5️⃣ Approve Booking (ADMIN/STAFF)
```
1. Login: admin / password
2. Menu Booking → Lihat booking menunggu
3. Klik tombol ✓ (Setujui) atau × (Tolak)
```

#### 6️⃣ Kelola User (ADMIN)
```
1. Login: admin / password
2. Menu Users → Tambah User
   - Nama: Staff Baru
   - Username: staffbaru
   - Email: staffbaru@perpustakaan.com
   - Password: password
   - Role: Staff
3. Klik Simpan
```

## 🎯 Fitur yang Bisa Didemokan

### ✅ CRUD Lengkap:
- [x] Anggota (dengan auto-create user)
- [x] Buku
- [x] Peminjaman (multi-buku)
- [x] Booking
- [x] Denda
- [x] Users (Admin, Staff, Staff Stock)

### ✅ Logika Bisnis:
- [x] Peminjaman → Stok buku otomatis berkurang
- [x] Pengembalian → Stok buku otomatis bertambah
- [x] Keterlambatan → Denda otomatis terhitung (Rp 1.000/hari)
- [x] Booking → Status (Menunggu/Disetujui/Ditolak)
- [x] Validasi stok buku sebelum peminjaman

### ✅ Role-Based Access:
- [x] Admin: Akses semua modul
- [x] Staff: Kelola anggota, peminjaman, denda
- [x] Staff Stock: Kelola buku & stok
- [x] Anggota: Booking, lihat riwayat, lihat denda

## 📊 Data Sample yang Tersedia

### User Login:
- 1 Admin
- 1 Staff
- 1 Staff Stock
- 2 Anggota (budi, siti)

### Buku Sample:
- 10 buku populer Indonesia
- Variasi stok (4-15 buku)

## 🔧 Jika Ada Error

### Clear Cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Restart Server:
```bash
Ctrl+C (stop server)
php artisan serve
```

## 📱 URL Penting

- Login: http://127.0.0.1:8000/login
- Dashboard Admin: http://127.0.0.1:8000/admin/dashboard
- Dashboard Staff: http://127.0.0.1:8000/staff/dashboard
- Dashboard Staff Stock: http://127.0.0.1:8000/staff-stock/dashboard
- Dashboard Anggota: http://127.0.0.1:8000/anggota/dashboard

## ✨ Keunggulan Sistem

1. **UI Simple & Clean** - Fokus pada fungsionalitas
2. **Responsive** - Bootstrap 5
3. **Real-time Validation** - Input validation di semua form
4. **Auto Calculation** - Denda otomatis terhitung
5. **Stock Management** - Auto update stok buku
6. **Multi-role Access** - Setiap role punya akses berbeda
7. **Transaction Safe** - Menggunakan database transaction
8. **User Friendly** - Easy navigation & clear feedback

## 🎓 Untuk Presentasi UAS

### Poin-poin Demo:
1. ✅ Login multi-role
2. ✅ Dashboard sesuai role
3. ✅ CRUD semua modul
4. ✅ Peminjaman multi-buku
5. ✅ Auto kurang stok saat pinjam
6. ✅ Auto hitung denda saat telat
7. ✅ Auto kembalikan stok saat pengembalian
8. ✅ Booking system dengan approval
9. ✅ Relasi database (foreign key)
10. ✅ Validasi bisnis rules

---

**💡 Tips:**
- Gunakan browser incognito untuk test multi-user
- Screenshot setiap proses untuk presentasi
- Siapkan skenario demo yang smooth

**🎉 Selamat mengerjakan UAS! Good luck!**
