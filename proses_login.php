<?php
session_start();
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header("Location: index.php"); exit; }

$username = trim($_POST['username']);
$password = $_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT id, username, nama_lengkap, password FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama']     = $user['nama_lengkap'];

    // Remember Me: simpan username di cookie 7 hari
    if (isset($_POST['remember'])) {
        setcookie('remember_username', $user['username'], time() + (7 * 24 * 60 * 60), "/");
    } else {
        setcookie('remember_username', '', time() - 3600, "/");
    }
    header("Location: dashboard.php");
} else {
    header("Location: index.php?pesan=gagal");
}
exit;
