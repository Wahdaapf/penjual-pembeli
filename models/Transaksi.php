<?php
    require_once __DIR__ . '/../config/db.php';
    function getTransactionBuyer($user_id) {
        $conn = koneksi();
        return mysqli_query($conn, "SELECT * FROM transactions WHERE user_id = $user_id");
    } 

    function addTransactionBuyer($data, $pembeli_id) {
        $conn = koneksi();
        $product_id = $data['product_id'];
        $quantity = $data['quantity'];
    
        $query = "INSERT INTO transactions (user_id, product_id, quantity) VALUES ('$pembeli_id', '$product_id', '$quantity')";
        return mysqli_query($conn, $query);
    }
?>