# Mini Digital Library

Aplikasi CRUD data buku berbasis **PHP Native + MySQL (mysqli)** dengan login, session, cookie (Remember Me), dan upload sampul buku.
UI memakai Bootstrap 5.

## Fitur
- Login (POST), Session, Cookie "Remember Me", Logout
- CRUD Buku (Create, Read, Update, Delete)
- Upload sampul (.jpg/.png, maks 2MB), file lama dihapus saat edit/hapus
- Status otomatis: stok > 0 = **Tersedia**, stok 0 = **Dipinjam**

## Cara Menjalankan
1. Salin folder ke `htdocs` XAMPP, nyalakan Apache & MySQL.
2. Import `db_perpustakaan.sql` lewat phpMyAdmin.
3. Sesuaikan `config/koneksi.php` jika perlu.
4. Buka `http://localhost/project_perpustakaan/`
5. Login: **admin / admin123**

## Struktur Tabel
**users**: id, username, password, nama_lengkap
**buku**: id, judul, kategori, penulis, tahun_terbit, stok, sampul

## Screenshot
> Tambahkan screenshot di sini (taruh di folder `screenshots/`):
- Halaman Login
- Dashboard
- Tambah Buku
- Edit Buku
- Struktur tabel database (phpMyAdmin)

## Video Demo
Link YouTube: (isi di sini)
