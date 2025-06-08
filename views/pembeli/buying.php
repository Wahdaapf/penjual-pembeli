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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 2rem;
        }

        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            max-width: 700px;
            margin: 0 auto;
        }

        h2 {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container form-container mt-5">
        <h2 class="mb-4">➕ Tambah Produk Baru</h2>

        <form action="../../controllers/ProdukController.php" method="POST">
            <input type="hidden" name="action" value="tambah">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-4">
                <label for="stok" class="form-label">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>

            <button type="submit" class="btn btn-success">💾 Simpan Produk</button>
            <a href="../../views/admin/dashboard.php" class="btn btn-outline-secondary ms-2">← Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
