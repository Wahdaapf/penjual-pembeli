<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once __DIR__ . '/../models/Transaksi.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'tambah') {
        $data = [
            'product_id' => $_POST['id'],
            'quantity' => $_POST['quantity']
        ];

        if ($_POST['quantity'] > $_POST['stok']) {
            header("Location: ../views/pembeli/buying.php?id=". $_POST['id'] ."&nama=" . urlencode($_POST['nama']) . "&harga=".$_POST['harga']."&stok=" . $_POST['stok'] . "&error=stok");
            exit();
        }
    
        $result = addTransactionBuyer($data, $_SESSION['user_id']);
    
        if ($result) {
            header('Location: ../views/pembeli/dashboard.php?status=sukses');
        } else {
            header('Location: ../views/pembeli/dashboard.php?status=gagal');
        }
        exit();
    }
    
    $transactionsBuyer = getTransactionBuyer($_SESSION['user_id']);
?>