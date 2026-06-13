<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
            max-width: 380px;
            padding: 36px 32px;
        }

        .box h1 {
            font-size: 20px;
            font-weight: 700;
            color: #111;
            margin-bottom: 4px;
        }

        .box p.sub {
            font-size: 13px;
            color: #888;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 13px;
            color: #111;
            font-family: inherit;
            transition: border-color 0.15s;
        }

        input:focus {
            outline: none;
            border-color: #111;
        }

        .btn {
            width: 100%;
            padding: 11px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
            transition: background 0.15s;
        }

        .btn:hover { background: #333; }

        .note {
            font-size: 11px;
            color: #aaa;
            text-align: center;
            margin-top: 16px;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Buat Akun</h1>
    <p class="sub">Konfirmasi akan dikirim ke email Anda</p>

    <form action="send_email.php" method="POST">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="username" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="email@gmail.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Minimal 8 karakter" required>
        </div>

        <button type="submit" class="btn">Daftar Sekarang</button>
    </form>

    <p class="note">PHPMailer 6.9 · SMTP Google</p>
</div>

</body>
</html>