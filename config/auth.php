<?php
// Cek session: halaman yang meng-include file ini wajib login
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?pesan=belum_login");
    exit;
}
