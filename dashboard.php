<?php
include 'config/auth.php';
include 'config/koneksi.php';
include 'config/upload.php';

$judulHalaman = "Dashboard";
$data = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
$total = mysqli_num_rows($data);
$pesan = $_GET['pesan'] ?? '';
include 'config/header.php';
?>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Total Buku</small>
            <h2 class="fw-bold mb-0"><?= $total ?></h2>
        </div>
    </div>
</div>

<?php if ($pesan == 'tambah'): ?><div class="alert alert-success">Buku berhasil ditambahkan.</div>
<?php elseif ($pesan == 'edit'): ?><div class="alert alert-success">Buku berhasil diubah.</div>
<?php elseif ($pesan == 'hapus'): ?><div class="alert alert-success">Buku berhasil dihapus.</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Daftar Buku</h5>
            <a href="tambah_buku.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Buku</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th><th>Sampul</th><th>Judul</th><th>Kategori</th>
                        <th>Penulis</th><th>Tahun</th><th>Stok</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                    <?php $status = labelStatus((int)$row['stok']); ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php if ($row['sampul'] && file_exists("uploads/" . $row['sampul'])): ?>
                                <img src="uploads/<?= htmlspecialchars($row['sampul']) ?>" class="sampul">
                            <?php else: ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-semibold"><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                        <td><?= htmlspecialchars($row['penulis']) ?></td>
                        <td><?= $row['tahun_terbit'] ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td>
                            <span class="badge <?= $status == 'Tersedia' ? 'bg-success' : 'bg-danger' ?>"><?= $status ?></span>
                        </td>
                        <td>
                            <a href="edit_buku.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <a href="hapus_buku.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin hapus buku ini?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($total == 0): ?>
                    <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data buku.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'config/footer.php'; ?>
