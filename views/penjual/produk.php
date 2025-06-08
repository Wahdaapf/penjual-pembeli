<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require '../../functions.php';
    session();

    if (!isset($_SESSION['login']) || $_SESSION['role'] != 1) {
        header('Location: ../../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-form {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 4rem auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-form">
            <h3 class="mb-4 text-center">🛍️ Tambah Produk Baru</h3>
            <form action="../../controllers/ProdukController.php" method="POST">
                <input type="hidden" name="action" value="tambah">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Kopi Arabika" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Contoh: 15000" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Contoh: 25" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../penjual/dashboard.php" class="btn btn-outline-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">✅ Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
