<?php
    require_once __DIR__ . '/../models/Produk.php';
    $produk = getProdukByPenjual($_SESSION['user_id']);
    $statistik = getStatistikProduk($_SESSION['user_id']);
?>