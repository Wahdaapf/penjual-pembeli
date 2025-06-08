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

  if (isset($_POST['login'])) {
    $login = login($_POST);
  }
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
        max-width: 400px;
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h3 class="text-center mb-4">Halaman Login</h3>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="text"
            name="email"
            class="form-control"
            id="email"
            placeholder="Masukkan Email"
            required
          />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Masukkan password"
            required
          />
        </div>
        <div class="d-grid gap-2">
          <button type="submit" name="login" class="btn btn-primary">Login</button>
        </div>
        <div class="text-center mt-3">
          <small>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></small>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
