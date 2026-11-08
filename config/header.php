<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judulHalaman ?? 'Mini Digital Library' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background:#f3f4f6; }
        .navbar { background:linear-gradient(135deg,#4f46e5,#06b6d4); }
        .sampul { width:50px; height:70px; object-fit:cover; border-radius:6px; }
        .card { border:0; border-radius:1rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php"><i class="bi bi-book-half"></i> Mini Digital Library</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['nama']) ?></span>
            <a href="logout.php" class="btn btn-light btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</nav>
<div class="container">
