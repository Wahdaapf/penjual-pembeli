<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  require 'functions.php';

  if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 1) {
      header('Location: views/penjual/dashboard.php');
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
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: #f8f9fa;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .card {
        padding: 2rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        width: 100%;
        max-width: 500px;
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h3 class="text-center mb-4">Halaman Registrasi</h3>
      <form action="registrasi.php" method="POST">
        <div class="mb-3">
          <label for="fullname" class="form-label">Nama Lengkap</label>
          <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required />
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password</label>
          <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Ulangi password" required />
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Pilih Role</label>
          <select name="role" class="form-select" id="role" required>
            <option value="1">Penjual</option>
            <option value="2">Pembeli</option>
          </select>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" name="register" class="btn btn-primary">Daftar</button>
        </div>
        <div class="text-center mt-3">
          <small>Sudah punya akun? <a href="index.php">Login di sini</a></small>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
