<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Validasi kredensial (dummy data)
if ($username == "irma" && $password == "123") {

    // Set Session
    $_SESSION['login'] = true;
    $_SESSION['user']  = $username;

    // Cek apakah "Remember Me" dicentang
    if (isset($_POST['remember'])) {
        // Simpan cookie username selama 1 jam
        setcookie('username', $username, time() + 3600, "/");

        // Simpan cookie key (hash) sebagai keamanan ganda
        $key = hash('sha256', $username);
        setcookie('key', $key, time() + 3600, "/");
    } else {
        // Hapus cookie jika "Remember Me" tidak dicentang
        setcookie('username', '', time() - 3600, "/");
        setcookie('key', '', time() - 3600, "/");
    }

    // Redirect ke halaman utama
    header("Location: ../index.php");
    exit;

} else {
    // Login gagal: redirect kembali ke login dengan pesan error
    header("Location: ../login.php?error=1");
    exit;
}
?>