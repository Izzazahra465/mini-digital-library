<?php
include 'config/auth.php';
include 'config/koneksi.php';
$judulHalaman = "Edit Buku";

$id = (int)($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, "SELECT * FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$row) { header("Location: dashboard.php"); exit; }

$error = $_GET['error'] ?? '';
$kategoriList = ['Pemrograman', 'Basis Data', 'Jaringan', 'Novel', 'Lainnya'];
include 'config/header.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-pencil-square"></i> Edit Buku</h5>
                <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <form action="proses_edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <?php foreach ($kategoriList as $k): ?>
                                <option <?= $row['kategori'] == $k ? 'selected' : '' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($row['penulis']) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control" value="<?= $row['tahun_terbit'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok (0 = Dipinjam)</label>
                            <input type="number" name="stok" class="form-control" min="0" value="<?= $row['stok'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Sampul Saat Ini</label>
                        <?php if ($row['sampul'] && file_exists("uploads/" . $row['sampul'])): ?>
                            <img src="uploads/<?= htmlspecialchars($row['sampul']) ?>" class="sampul mb-2" style="width:80px;height:110px">
                        <?php else: ?>
                            <p class="text-muted small">Belum ada sampul.</p>
                        <?php endif; ?>
                        <input type="file" name="sampul" class="form-control" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti sampul.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'config/footer.php'; ?>
