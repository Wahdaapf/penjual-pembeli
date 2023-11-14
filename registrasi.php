<?php
    session_start();
    require 'functions.php';

    if (isset($_SESSION['login'])) {
        // Jika sesi sudah ada, redirect ke halaman dashboard
        if($_SESSION['role'] == 1) {
            header('Location: views/penjual/dashboard.php');  // Ubah sesuai dengan nama file dashboard Anda
        } else {
            header('Location: views/pembeli/dashboard.php');
        }
        exit();
    }

    if (isset($_POST['register'])) {
        $login = register($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Halaman Register</h1>
        <form action="registrasi.php" method="POST">
            <div class="mb-3 mt-3">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Masukkan Konfirm password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Pilih Role</label>
                <select name="role" class="form-control" id="role">
                    <option value="1">Penjual</option>
                    <option value="2">Pembeli</option>
                </select>
            </div>
            <button type="submit" name="register" class="btn btn-primary mb-3">Submit</button>
            <p>Sudah Punya Akun? <a href="login.html">Login</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>