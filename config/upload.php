<?php
// Fungsi bantu upload sampul buku
// Return: ['ok'=>bool, 'nama'=>string|null, 'error'=>string|null]
function uploadSampul(array $file, string $folder = __DIR__ . "/../uploads/"): array
{
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => true, 'nama' => null, 'error' => null]; // tidak upload
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'nama' => null, 'error' => 'Upload gagal (kode ' . $file['error'] . ').'];
    }
    // Validasi ukuran maks 2MB
    if ($file['size'] > 2 * 1024 * 1024) {
        return ['ok' => false, 'nama' => null, 'error' => 'Ukuran file maksimal 2MB.'];
    }
    // Validasi ekstensi
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png'];
    if (!in_array($ext, $allowedExt)) {
        return ['ok' => false, 'nama' => null, 'error' => 'Format harus .jpg atau .png.'];
    }
    // Validasi tipe asli file (MIME)
    $mime = mime_content_type($file['tmp_name']);
    if (!in_array($mime, ['image/jpeg', 'image/png'])) {
        return ['ok' => false, 'nama' => null, 'error' => 'File bukan gambar yang valid.'];
    }
    if (!is_dir($folder)) { mkdir($folder, 0777, true); }
    $namaBaru = uniqid('sampul_', true) . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $folder . $namaBaru)) {
        return ['ok' => false, 'nama' => null, 'error' => 'Gagal menyimpan file.'];
    }
    return ['ok' => true, 'nama' => $namaBaru, 'error' => null];
}

function hapusFileSampul(?string $nama, string $folder = __DIR__ . "/../uploads/"): void
{
    if ($nama && file_exists($folder . $nama)) {
        unlink($folder . $nama);
    }
}

// Logika status: stok > 0 = Tersedia, selain itu Dipinjam
function labelStatus(int $stok): string
{
    if ($stok > 0) { return "Tersedia"; }
    return "Dipinjam";
}
