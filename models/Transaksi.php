<?php
    require_once __DIR__ . '/../config/db.php';

    function getTransactionBuyer($user_id) {
        $conn = koneksi();
        $query = "
            SELECT 
                t.id AS transaction_id,
                t.created_at,
                t.quantity,
    
                p.id AS product_id,
                p.nama AS product_name,
                p.harga AS product_price,
    
                seller.id AS seller_id,
                seller.fullname AS seller_name,
                seller.email AS seller_email
    
            FROM transactions t
            JOIN products p ON t.product_id = p.id
            JOIN users seller ON p.user_id = seller.id
    
            WHERE t.user_id = $user_id
        ";
    
        return mysqli_query($conn, $query);
    }      

    function addTransactionBuyer($data, $pembeli_id) {
        $conn = koneksi();
        $product_id = $data['product_id'];
        $quantity = $data['quantity'];

        $cekStok = mysqli_query($conn, "SELECT stok FROM products WHERE id = $product_id");
        $produk = mysqli_fetch_assoc($cekStok);
    
        $query = "INSERT INTO transactions (user_id, product_id, quantity) VALUES ('$pembeli_id', '$product_id', '$quantity')";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            // Kurangi stok
            $stokBaru = $produk['stok'] - $quantity;
            mysqli_query($conn, "UPDATE products SET stok = $stokBaru WHERE id = $product_id");
        }

        return $result;
    }
?>