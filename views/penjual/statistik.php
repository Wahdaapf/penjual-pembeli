<?php
    require '../../functions.php';
    require '../../controllers/ProdukController.php';

    session();

    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['logout'])) {
        logout();
    }

    $user_id = $_SESSION['user_id'];
?>

<?php
    #pagination

    $data = [];
    while ($stat = mysqli_fetch_assoc($statistik)) {
        $data[] = $stat;
    }

    $chunks = array_chunk($data, 5);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Penjual</title>
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
    <!-- Logout button -->
    <a href="?logout=true" class="btn btn-outline-danger logout-btn">Logout</a>

    <!-- Header -->
    <div class="dashboard-header ">
      <h1 class="text-primary">📋 Dashboard Penjual</h1>
      <p class="lead">Selamat datang kembali, kelola produk dan pantau statistik penjualanmu di sini.</p>
      <a href="dashboard.php" class="btn btn-warning"><- Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            📊 Statistik Penjualan
        </div>
        <div class="card-body">
            <?php foreach ($chunks as $index => $chunk): ?>
            <div class="tab-content" id="tab-<?= $index ?>" style="display: none;">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Total Unit Terjual</th>
                    <th>Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chunk as $stat): ?>
                    <tr>
                        <td><?= htmlspecialchars($stat['nama']) ?></td>
                        <td>Rp<?= number_format($stat['harga'], 0, ',', '.') ?></td>
                        <td><?= (int)$stat['total_terjual'] ?></td>
                        <td><?= (int)$stat['jumlah_transaksi'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <?php endforeach; ?>

            <div class="mb-3">
                <?php foreach ($chunks as $index => $_): ?>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
