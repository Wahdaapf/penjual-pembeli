<?php

    function koneksi() {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'penjual_pembeli';

        return mysqli_connect($hostname, $username, $password, $dbname);
    }

    function session() {
        $timeout = 25 * 60;
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }

        $_SESSION['last_activity'] = time();
    }

?>