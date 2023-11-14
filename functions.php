<?php

    function koneksi() {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'login_register';

        return mysqli_connect($hostname, $username, $password, $dbname);
    }

    function session() {
        // session_start();
        $timeout = 25 * 60;
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }

        $_SESSION['last_activity'] = time();
    }

    function login($data) {
        session_start();
        $conn = koneksi();
        $email = $data['email'];
        $password = $data['password'];
    
        $query = "SELECT * FROM users WHERE email = '$email'";
    
        $result = mysqli_query($conn, $query);
    
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['role'] = $row['role'];
                header('Location: ' . ($row['role'] == 1 ? 'views/penjual/dashboard.php' : 'views/pembeli/dashboard.php'));
            } else {
                echo "Login Gagal: Password tidak cocok";
            }
        } else {
            echo "Login Gagal: Email tidak terdaftar";
        }
    }

    function register($data) {
        $conn = koneksi();
        $fullname = $data['fullname'];
        $email = $data['email'];
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];
        $role = $data['role'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$password_hash', '$role')";

        if(mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo "Pendaftaran Gagal: " . mysqli_error($conn);
        }
    }

    function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit;
    }

?>