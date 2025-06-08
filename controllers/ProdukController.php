<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once __DIR__ . '/../models/Produk.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'tambah') {
        $data = [
            'nama' => $_POST['nama'],
            'harga' => $_POST['harga'],
            'stok' => $_POST['stok']
        ];
    
        $result = tambahProduk($data, $_SESSION['user_id']);
    
        if ($result) {
            header('Location: ../views/penjual/dashboard.php?status=sukses');
        } else {
            header('Location: ../views/penjual/dashboard.php?status=gagal');
        }
        exit();
    }
    
    $produkPenjual = getProdukByPenjual($_SESSION['user_id']);
    $statistik = getStatistikProduk($_SESSION['user_id']);
    $produk = getAllProduk();
?>