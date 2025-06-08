<?php
    require_once __DIR__ . '/../config/db.php';
    function getProdukByPenjual($user_id) {
        $conn = koneksi();
        return mysqli_query($conn, "SELECT * FROM products WHERE user_id = $user_id");
    }  

    function getAllProduk() {
        $conn = koneksi();
        return mysqli_query($conn, "SELECT * FROM products");
    }  

    function getStatistikProduk($user_id) {
        $conn = koneksi();
        return mysqli_query($conn, "
            SELECT p.id, p.nama, p.harga,
                   IFNULL(SUM(t.quantity), 0) AS total_terjual,
                   COUNT(t.id) AS jumlah_transaksi
            FROM products p
            LEFT JOIN transactions t ON p.id = t.product_id
            WHERE p.user_id = $user_id
            GROUP BY p.id
            ORDER BY p.nama ASC
        ");
    }

    function tambahProduk($data, $penjual_id) {
        $conn = koneksi();
        $nama = $data['nama'];
        $harga = $data['harga'];
        $stok = $data['stok'];
    
        $query = "INSERT INTO products (nama, harga, stok, user_id) VALUES ('$nama', '$harga', '$stok', '$penjual_id')";
        return mysqli_query($conn, $query);
    }
?>