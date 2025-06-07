<?php
    session_start();
    require '../../functions.php';
    require '../../controllers/ProdukController.php';

    session();

    if (!isset($_SESSION['login'])) {
        header('Location: index.php'); // Redirect jika belum login
        exit();
    }

    if (isset($_GET['logout'])) {
        logout();
    }

    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Halaman Dashboard Penjual</h1>
    </div>
    <a href="?logout=true">Logout</a>
    <a href="tambah-produk.php" class="btn btn-success mt-4">+ Tambah Produk</a>
    <h3>📦 Daftar Produk Anda</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>📊 Statistik Penjualan</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Total Unit Terjual</th>
                <th>Jumlah Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($stat = mysqli_fetch_assoc($statistik)) : ?>
                <tr>
                    <td><?= htmlspecialchars($stat['nama']) ?></td>
                    <td>Rp<?= number_format($stat['harga'], 0, ',', '.') ?></td>
                    <td><?= $stat['total_terjual'] ?></td>
                    <td><?= $stat['jumlah_transaksi'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>