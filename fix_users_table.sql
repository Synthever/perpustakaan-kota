-- SQL untuk menambahkan kolom yang diperlukan ke tabel users
-- Jalankan di MySQL/phpMyAdmin atau via terminal MySQL

USE perpustakaan_kota;

-- Tambah kolom username jika belum ada
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `username` VARCHAR(255) NULL AFTER `name`;

-- Tambah kolom role jika belum ada  
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `role` ENUM('admin', 'staff', 'staff_stock', 'anggota') NOT NULL DEFAULT 'anggota' AFTER `password`;

-- Tambah kolom id_anggota jika belum ada
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `id_anggota` BIGINT UNSIGNED NULL AFTER `role`;

-- Tambah foreign key untuk id_anggota (cek dulu apakah sudah ada)
-- ALTER TABLE `users` 
-- ADD CONSTRAINT `users_id_anggota_foreign` 
-- FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE;

-- Update existing users (opsional, jika ada user yang belum punya username)
UPDATE `users` SET `username` = `email` WHERE `username` IS NULL OR `username` = '';

-- Setelah kolom ada, bisa set NOT NULL untuk username
ALTER TABLE `users` MODIFY COLUMN `username` VARCHAR(255) NOT NULL;
