<?php
session_start();

if (!isset($_GET['id'], $_GET['nama'], $_GET['harga'])) {
    echo "Data produk tidak lengkap.";
    exit;
}

$id = $_GET['id'];
$nama = $_GET['nama'];
$harga = $_GET['harga'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 2rem;
        }

        .transaksi-container {
            background: #fff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container transaksi-container mt-5">
        <h2 class="mb-4">💳 Transaksi Produk</h2>

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Produk:</label>
            <p class="form-control-plaintext"><?= htmlspecialchars($nama) ?></p>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Harga:</label>
            <p class="form-control-plaintext text-success">Rp<?= number_format($harga, 0, ',', '.') ?></p>
        </div>

        <form action="../../controllers/TransaksiController.php" method="POST">
            <input type="hidden" name="action" value="tambah">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="nama" value="<?= htmlspecialchars($nama) ?>">
            <input type="hidden" name="harga" value="<?= $harga ?>">

            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">🛒 Bayar Sekarang</button>
            <a href="../../views/pembeli/dashboard.php" class="btn btn-outline-secondary ms-2">← Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
        