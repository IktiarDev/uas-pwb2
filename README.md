# Perpustakaan Buku Digital (Pustaka Digital)

Aplikasi web Perpustakaan Buku Digital berbasis **CodeIgniter 4** dan **MySQL**, yang dirancang dengan antarmuka modern bertema **Eid Adha** menggunakan **Tailwind CSS**. Aplikasi ini dibangun untuk memenuhi kriteria UAS Pemrograman Web 2.

## Fitur Utama

1. **Autentikasi & Manajemen Sesi (Session Handling)**:
   - Pembatasan rute akses menggunakan middleware filter (`AuthFilter`).
   - Pembagian peran pengguna (Role-based access):
     - **Admin**: Memiliki akses penuh untuk melihat, menambah, mengubah, dan menghapus buku (CRUD).
     - **Member**: Memiliki akses baca-saja (read-only) untuk melihat katalog dan detail buku.
2. **Book CRUD (Create, Read, Update, Delete)**:
   - Fitur pengelolaan buku lengkap oleh Admin.
   - Mendukung pengunggahan cover buku (*image file upload*).
3. **AJAX Live Search & AJAX Pagination (Single Page Experience)**:
   - Pencarian buku secara real-time langsung saat pengguna mengetik (dengan *debounce* 300ms untuk optimasi server).
   - Perpindahan halaman katalog secara dinamis tanpa melakukan reload seluruh halaman web (AJAX).
   - Sinkronisasi URL otomatis menggunakan HTML5 History API agar pencarian tetap presisi saat halaman di-refresh.

## Teknologi yang Digunakan

- **Backend**: PHP 8.1+ / CodeIgniter 4.7.4
- **Database**: MySQL / MariaDB
- **Frontend**: Vanilla CSS & Tailwind CSS (via CDN)
- **Interaksi Klien**: Vanilla JavaScript (Fetch API & DOMParser)

---

## Cara Instalasi

### 1. Persiapan Berkas
Ekstrak atau letakkan berkas proyek ini di dalam direktori server lokal Anda, misalnya pada WampServer:
`C:\wamp64\www\kuliah\uas-pw2`

### 2. Konfigurasi Database
1. Buka database manager lokal Anda (phpMyAdmin, Adminer, dll).
2. Buat database baru bernama `perpustakaan_digital`.
3. Impor berkas **`database.sql`** yang disertakan di root direktori proyek ini ke dalam database baru tersebut.

*Alternatif (jika ingin menginisialisasi ulang database kosong melalui Spark CLI):*
```bash
php spark db:create perpustakaan_digital
php spark migrate
php spark db:seed UserSeeder
php spark db:seed BookSeeder
```

### 3. Konfigurasi Environment (`.env`)
Salin berkas `env` di root direktori proyek menjadi `.env` lalu sesuaikan dengan konfigurasi MySQL server Anda:
```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost/kuliah/uas-pw2/public/'
app.indexPage = ''

database.default.hostname = localhost
database.default.database = perpustakaan_digital
database.default.username = root
database.default.password = ""
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

## Cara Menjalankan Aplikasi

Ada dua cara untuk menjalankan aplikasi ini:

### Opsi A: Menggunakan Spark Server (Sangat Direkomendasikan)
1. Buka terminal (CMD / PowerShell / Git Bash) di root direktori proyek (`uas-pw2`).
2. Jalankan perintah server pengembangan:
   ```bash
   php spark serve
   ```
3. Akses aplikasi melalui browser pada alamat:
   `http://localhost:8080`

### Opsi B: Akses Langsung via WampServer Localhost
Pastikan layanan Apache dan MySQL pada WampServer aktif, lalu akses rute publik web di browser Anda pada alamat:
`http://localhost/kuliah/uas-pw2/public/`

---

## Kredensial Akun Default

Gunakan akun di bawah ini untuk menguji hak akses (role) masing-masing user:

| Role | Username | Password | Deskripsi |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `admin123` | Akses penuh (Katalog, Detail, Tambah, Edit, Hapus) |
| **Member** | `member` | `member123` | Akses terbatas (Hatalog, Detail, Live Search) |
