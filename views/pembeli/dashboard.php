<?php
    require '../../functions.php';
    require '../../controllers/ProdukController.php';
    require '../../controllers/TransaksiController.php';

    session();

    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['logout'])) {
        logout();
    }
?>
<?php
    $data1 = [];
    while ($stat = mysqli_fetch_assoc($produk)) {
        $data1[] = $stat;
    }

    $chunks1 = array_chunk($data1, 5);

    $stok_ada = array_filter($data1, fn($p) => $p['stok'] > 0);
    $stok_kosong = array_filter($data1, fn($p) => $p['stok'] <= 0);
    $data_terurut = array_merge($stok_ada, $stok_kosong);

    $chunks1 = array_chunk($data_terurut, 5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembeli</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .dashboard-header {
            margin-top: 50px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="?logout=true" class="btn btn-outline-danger logout-btn">Logout</a>

        <?php if (isset($_GET['status'])): ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                <div id="statusToast" class="toast align-items-center text-white <?= $_GET['status'] === 'sukses' ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    <?= $_GET['status'] === 'sukses' ? 'Transaksi berhasil!' : 'Transaksi gagal!' ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="dashboard-header ">
            <h1 class="text-primary">📋 Dashboard Pembeli</h1>
            <p class="lead">Selamat datang kembali, lihat produk terbaru disini dan riwayat transaksi mu.</p>
            <a href="riwayat.php" class="btn btn-warning">Lihat Riwayat Transaksi</a>
        </div>

        <!-- Daftar Produk -->
        <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            📦 Produk Dijual
        </div>
        <div class="card-body">
            <?php foreach ($chunks1 as $index => $chunk1): ?>
                <div class="tab-content" id="tab-<?= $index ?>" style="display: none;">
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chunk1 as $stat): ?>
                            <tr class="<?= $stat['stok'] == 0 ? 'text-muted' : '' ?>">
    <td><?= htmlspecialchars($stat['nama']) ?></td>
    <td>Rp<?= number_format($stat['harga'], 0, ',', '.') ?></td>
    <td><?= $stat['stok'] ?></td>
    <td>
        <a 
            href="../../views/pembeli/buying.php?id=<?= $stat['id'] ?>&nama=<?= urlencode($stat['nama']) ?>&harga=<?= $stat['harga'] ?>&stok=<?= $stat['stok'] ?>" 
            class="btn btn-sm <?= $stat['stok'] == 0 ? 'btn-secondary disabled' : 'btn-primary' ?>"
            <?= $stat['stok'] == 0 ? 'tabindex="-1" aria-disabled="true"' : '' ?>
        >
            <?= $stat['stok'] == 0 ? 'Stok Habis' : 'Beli Sekarang' ?>
        </a>
    </td>
</tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
            <div class="mb-3">
                <?php foreach ($chunks1 as $index => $_): ?>
                    <button class="btn btn-secondary tab-btn me-2" onclick="showTab(<?= $index ?>)"><?= $index + 1 ?></button>
                <?php endforeach; ?>
            </div>
            <script>
                function showTab(index) {
                    const tabs = document.querySelectorAll('.tab-content');
                    tabs.forEach(tab => tab.style.display = 'none');
                    document.getElementById('tab-' + index).style.display = 'block';
                }
                showTab(0);
            </script>
        </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('statusToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>