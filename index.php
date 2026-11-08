<?php
session_start();
if (isset($_SESSION['user_id'])) { header("Location: dashboard.php"); exit; }
$usernameCookie = $_COOKIE['remember_username'] ?? '';
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { min-height:100vh; background:linear-gradient(135deg,#4f46e5,#06b6d4); display:flex; align-items:center; }
        .card { border:0; border-radius:1rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg p-4">
                <div class="text-center mb-3">
                    <i class="bi bi-book-half text-primary" style="font-size:3rem"></i>
                    <h4 class="fw-bold mt-2">Mini Digital Library</h4>
                    <p class="text-muted small">Silakan login untuk melanjutkan</p>
                </div>
                <?php if ($pesan == 'gagal'): ?>
                    <div class="alert alert-danger py-2">Username atau password salah.</div>
                <?php elseif ($pesan == 'belum_login'): ?>
                    <div class="alert alert-warning py-2">Silakan login terlebih dahulu.</div>
                <?php elseif ($pesan == 'logout'): ?>
                    <div class="alert alert-success py-2">Anda berhasil logout.</div>
                <?php endif; ?>
                <form action="proses_login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($usernameCookie) ?>" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?= $usernameCookie ? 'checked' : '' ?>>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="text-center text-muted small mt-3 mb-0">Demo: admin / admin123</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
