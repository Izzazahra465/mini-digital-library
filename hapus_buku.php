<?php
include 'config/auth.php';
include 'config/koneksi.php';
include 'config/upload.php';

$id = (int)($_GET['id'] ?? 0);

// Ambil nama file sampul dulu
$stmt = mysqli_prepare($conn, "SELECT sampul FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($row) {
    // Hapus data di database
    $stmt = mysqli_prepare($conn, "DELETE FROM buku WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    // Hapus file fisik (unlink)
    hapusFileSampul($row['sampul']);
}

header("Location: dashboard.php?pesan=hapus");
exit;
