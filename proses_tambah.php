<?php
include 'config/auth.php';
include 'config/koneksi.php';
include 'config/upload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header("Location: dashboard.php"); exit; }

$judul    = trim($_POST['judul']);
$kategori = $_POST['kategori'];
$penulis  = trim($_POST['penulis']);
$tahun    = (int)$_POST['tahun_terbit'];
$stok     = (int)$_POST['stok'];

// Upload sampul
$up = uploadSampul($_FILES['sampul']);
if (!$up['ok']) {
    header("Location: tambah_buku.php?error=" . urlencode($up['error']));
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO buku (judul, kategori, penulis, tahun_terbit, stok, sampul) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssiis", $judul, $kategori, $penulis, $tahun, $stok, $up['nama']);
mysqli_stmt_execute($stmt);

header("Location: dashboard.php?pesan=tambah");
exit;
