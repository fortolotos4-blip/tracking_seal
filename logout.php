<?php
// Mulai session
session_start();

// Cek apakah session terdaftar
if(isset($_SESSION['username'])) {
    // Session terdaftar, saatnya logout
    session_unset(); // Hapus semua variabel session
    session_destroy(); // Hapus session data

    // Memberitahu pengguna bahwa logout berhasil dan memberikan permalink untuk login
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "https://tracking-container.infinityfreeapp.com/"; }, 500);</script>';
} else {
    // Variabel session salah, user tidak seharusnya ada di halaman ini. Kembalikan ke login
    echo '<script type="text/javascript">window.location.href = "https://tracking-container.infinityfreeapp.com/";</script>';
    exit; // Pastikan tidak ada kode yang dieksekusi setelah melakukan redirect
}
?>