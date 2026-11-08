<?php
include 'config/auth.php';
$judulHalaman = "Tambah Buku";
$error = $_GET['error'] ?? '';
include 'config/header.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle"></i> Tambah Buku</h5>
                <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option>Pemrograman</option><option>Basis Data</option>
                            <option>Jaringan</option><option>Novel</option><option>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control" min="1900" max="2100" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok (0 = Dipinjam)</label>
                            <input type="number" name="stok" class="form-control" min="0" value="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sampul Buku (.jpg/.png, maks 2MB)</label>
                        <input type="file" name="sampul" class="form-control" accept=".jpg,.jpeg,.png">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'config/footer.php'; ?>
