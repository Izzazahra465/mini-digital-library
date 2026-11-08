<?php
include 'config/auth.php';
include 'config/koneksi.php';
include 'config/upload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header("Location: dashboard.php"); exit; }

$id       = (int)$_POST['id'];
$judul    = trim($_POST['judul']);
$kategori = $_POST['kategori'];
$penulis  = trim($_POST['penulis']);
$tahun    = (int)$_POST['tahun_terbit'];
$stok     = (int)$_POST['stok'];

// Ambil sampul lama
$stmt = mysqli_prepare($conn, "SELECT sampul FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$lama = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$lama) { header("Location: dashboard.php"); exit; }

$up = uploadSampul($_FILES['sampul']);
if (!$up['ok']) {
    header("Location: edit_buku.php?id=$id&error=" . urlencode($up['error']));
    exit;
}

if ($up['nama']) {
    // Ada file baru: ganti sampul, hapus file lama
    $stmt = mysqli_prepare($conn, "UPDATE buku SET judul=?, kategori=?, penulis=?, tahun_terbit=?, stok=?, sampul=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssiisi", $judul, $kategori, $penulis, $tahun, $stok, $up['nama'], $id);
    mysqli_stmt_execute($stmt);
    hapusFileSampul($lama['sampul']);
} else {
    // Tanpa file baru: sampul tetap
    $stmt = mysqli_prepare($conn, "UPDATE buku SET judul=?, kategori=?, penulis=?, tahun_terbit=?, stok=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssiii", $judul, $kategori, $penulis, $tahun, $stok, $id);
    mysqli_stmt_execute($stmt);
}

header("Location: dashboard.php?pesan=edit");
exit;
