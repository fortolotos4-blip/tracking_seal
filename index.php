
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT username, password, usertype
            FROM login
            WHERE username = ?";

    $stmt = mysqli_prepare($koneksi, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result(
        $stmt,
        $db_username,
        $db_password,
        $db_usertype
    );

    $valid = false;

    if (mysqli_stmt_fetch($stmt)) {

        // Mendukung password hash maupun password lama
        if (password_verify($password, $db_password)) {
            $valid = true;

        } elseif (hash_equals($db_password, $password)) {

            // Migrasi otomatis password lama ke hash
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $update = mysqli_prepare(
                $koneksi,
                "UPDATE login SET password = ? WHERE username = ?"
            );

            mysqli_stmt_bind_param(
                $update,
                "ss",
                $hash,
                $db_username
            );

            mysqli_stmt_execute($update);
            mysqli_stmt_close($update);

            $valid = true;
        }
    }

    mysqli_stmt_close($stmt);

    if ($valid) {

        session_regenerate_id(true);

        $_SESSION["username"] = $db_username;
        $_SESSION["usertype"] = $db_usertype;

        if ($db_usertype == "admin") {
            header("Location: index_admin.php");
            exit;
        }

        elseif ($db_usertype == "penyelia") {
            header("Location: index_penyelia.php");
            exit;
        }

        else {
            $pesan = "Hak akses pengguna tidak dikenali.";
        }

    } else {
        $pesan = "Username atau password salah.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Tracking Container</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 380px;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error-message {
            color: #dc2626;
            background: #fef2f2;
            padding: 10px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-header">
            <h2>Tracking Container</h2>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        <?php if (!empty($pesan)): ?>
            <div class="error-message">
                <?= htmlspecialchars($pesan) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit">Login</button>

        </form>

        <div class="footer">
            Tracking Container Management System
        </div>

    </div>

</body>
</html>

