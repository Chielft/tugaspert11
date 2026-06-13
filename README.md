# Tugas Pertemuan 11 - Library PHP PHPMailer
Komang Santika Juliartha (240040045)

**Mata Kuliah:** Pemrograman Web Sisi Server 
**Topik:** Library PHP - PHPMailer  
**Dosen:** Gede Herdian Setiawan, S.Kom., M.T.

---

## Deskripsi

Proyek ini adalah implementasi latihan dari materi **Library PHP** pertemuan 11.  
Studi kasus yang digunakan adalah **mengirim email konfirmasi pendaftaran akun** menggunakan library **PHPMailer** dengan **SMTP Google**.

---

## Library yang Digunakan

| Library | Versi | Fungsi |
|---|---|---|
| phpmailer/phpmailer | 6.9 | Pengiriman email via SMTP Google |

---

## Struktur Proyek

```
tugaspert11/
├── index.php        → Form pendaftaran akun
├── send_email.php   → Proses kirim email konfirmasi (PHPMailer)
├── composer.json    → Definisi dependency
├── .gitignore       → Mengabaikan folder vendor/
└── vendor/          → Library hasil Composer (tidak di-upload ke GitHub)
```

---

## Cara Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/username/tugaspert11.git
```

### 2. Install Dependency
```bash
cd tugaspert11
composer install
```

### 3. Konfigurasi SMTP Google
Buka `send_email.php`, edit bagian berikut:
```php
define('SMTP_USER', 'emailanda@gmail.com');  // Ganti dengan Gmail Anda
define('SMTP_PASS', 'xxxx xxxx xxxx xxxx');  // App Password Google
```

> **Cara membuat App Password Google:**
> 1. Buka https://myaccount.google.com/security
> 2. Aktifkan 2-Step Verification
> 3. Buka https://myaccount.google.com/apppasswords
> 4. Buat App Password → salin 16 karakter yang digenerate

### 4. Jalankan di Localhost
Letakkan folder di `htdocs` XAMPP, lalu akses:
```
http://localhost/tugaspert11/index.php
```

---

## Cara Kerja

1. User mengisi form pendaftaran (nama, username, email, password)
2. Data dikirim ke `send_email.php` via method POST
3. PHPMailer memproses pengiriman email menggunakan SMTP Google
4. Email konfirmasi otomatis terkirim ke email pendaftar
5. Halaman sukses/gagal ditampilkan

---

## Perintah Composer

```bash
# Install semua library
composer install

# Tambah library baru
composer require phpmailer/phpmailer

# Cek library yang terinstall
composer show
```

---

## Autoloading (PSR-4)

```php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
```

---

*Institut Teknologi dan Bisnis STIKOM Bali - Always The First*