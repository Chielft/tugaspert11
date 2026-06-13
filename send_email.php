<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Konfigurasi SMTP
define('SMTP_HOST',     'smtp.gmail.com');
define('SMTP_PORT',     587);
define('SMTP_USER',     'admin@gmail.com');  // Ganti dengan email Anda
define('SMTP_PASS',     '1234 abcd 5678 efgh'); // Gunakan App Password
define('SMTP_FROM',     'admin@gmail.com');
define('SMTP_FROMNAME', 'Konfirmasi Akun');

// Ambil data dari form
$nama     = htmlspecialchars(trim($_POST['nama']     ?? ''));
$username = htmlspecialchars(trim($_POST['username'] ?? ''));
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';

// Memvalidasi input
if (empty($nama) || empty($username) || empty($email) || empty($password)) {
    die('<p style="font-family:sans-serif;color:red;">Semua field wajib diisi.</p>');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('<p style="font-family:sans-serif;color:red;">Format email tidak valid.</p>');
}

if (strlen($password) < 8) {
    die('<p style="font-family:sans-serif;color:red;">Password minimal 8 karakter.</p>');
}

$tanggal = date('d F Y, H:i') . ' WIB';

$email_html = "
<!DOCTYPE html>
<html lang='id'>
<head>
<meta charset='UTF-8'>
<style>
    body    { font-family:'Segoe UI',sans-serif; background:#f4f4f4; margin:0; padding:0; }
    .wrap   { max-width:480px; margin:28px auto; background:#fff;
              border:1px solid #ddd; border-radius:8px; overflow:hidden; }
    .top    { background:#111; color:#fff; padding:24px 32px; }
    .top h2 { font-size:18px; font-weight:700; margin:0 0 4px; }
    .top p  { font-size:12px; color:#aaa; margin:0; }
    .body   { padding:28px 32px; }
    .body p { font-size:14px; color:#333; line-height:1.7; margin-bottom:12px; }
    table   { width:100%; border-collapse:collapse; margin:16px 0; }
    td      { padding:9px 0; font-size:13px; color:#333;
              border-bottom:1px solid #f5f5f5; }
    td:first-child { color:#888; width:40%; }
    tr:last-child td { border-bottom:none; }
    .footer { background:#f8f8f8; padding:14px 32px; border-top:1px solid #eee;
              font-size:11px; color:#aaa; text-align:center; }
</style>
</head>
<body>
<div class='wrap'>
    <div class='top'>
        <h2>Konfirmasi Pendaftaran</h2>
        <p>Akun Anda berhasil didaftarkan</p>
    </div>
    <div class='body'>
        <p>Halo <strong>{$nama}</strong>,</p>
        <p>Pendaftaran akun Anda telah berhasil. Berikut detail akun Anda:</p>

        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td>{$nama}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>{$username}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{$email}</td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td>{$tanggal}</td>
            </tr>
        </table>

        <p style='font-size:12px;color:#888;'>
            Simpan email ini sebagai bukti pendaftaran akun Anda.
        </p>
    </div>
    <div class='footer'>
        Email ini dikirim otomatis · Jangan membalas email ini
    </div>
</div>
</body>
</html>
";

// ---- KIRIM EMAIL DENGAN PHPMailer ----
$mail = new PHPMailer(true); // true = aktifkan exception

try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;

    $mail->setFrom(SMTP_FROM, SMTP_FROMNAME);
    $mail->addAddress($email, $nama);

    $mail->isHTML(true);
    $mail->CharSet  = 'UTF-8';
    $mail->Subject  = "Konfirmasi Pendaftaran Akun - {$username}";
    $mail->Body     = $email_html;
    $mail->AltBody  = "Halo {$nama}, akun Anda dengan username {$username} berhasil didaftarkan pada {$tanggal}.";

    $mail->send();
    $status = 'success';

} catch (Exception $e) {
    $status  = 'error';
    $errinfo = $mail->ErrorInfo;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI', sans-serif;
            background:#f4f4f4;
            min-height:100vh;
            display:flex; align-items:center; justify-content:center;
            padding:20px;
        }
        .box {
            background:#fff;
            border:1px solid #ddd;
            border-radius:8px;
            max-width:360px; width:100%;
            padding:36px 32px;
            text-align:center;
        }
        .icon  { font-size:38px; margin-bottom:14px; }
        h2     { font-size:18px; font-weight:700; color:#111; margin-bottom:8px; }
        p      { font-size:13px; color:#666; line-height:1.7; margin-bottom:6px; }
        .btn   { display:inline-block; margin-top:20px;
                 padding:10px 24px; background:#111; color:#fff;
                 border-radius:6px; text-decoration:none;
                 font-size:13px; font-weight:600; }
        .btn:hover { background:#333; }
        .err   { background:#fafafa; border-left:3px solid #ccc;
                 padding:10px 14px; border-radius:4px; text-align:left;
                 font-size:12px; color:#555; margin-top:12px; }
        .note  { font-size:11px; color:#bbb; margin-top:18px; }
    </style>
</head>
<body>
<div class="box">
    <?php if ($status === 'success'): ?>
        <div class="icon">✓</div>
        <h2>Pendaftaran Berhasil</h2>
        <p>Email konfirmasi dikirim ke<br><strong><?= htmlspecialchars($email) ?></strong></p>
        <p>Silakan cek inbox email Anda.</p>
        <a href="index.php" class="btn">← Kembali</a>
    <?php else: ?>
        <div class="icon">✕</div>
        <h2>Pendaftaran Gagal</h2>
        <p>Email konfirmasi tidak berhasil dikirim.</p>
        <div class="err"><?= htmlspecialchars($errinfo ?? '') ?></div>
        <a href="index.php" class="btn">← Coba Lagi</a>
    <?php endif; ?>
    <p class="note">PHPMailer 6.9 · smtp.gmail.com:587</p>
</div>
</body>
</html>