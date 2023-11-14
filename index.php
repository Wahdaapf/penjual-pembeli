<?php
    session_start();
    require 'functions.php';

    // Pengecekan apakah sesi sudah ada
    if (isset($_SESSION['login'])) {
        // Jika sesi sudah ada, redirect ke halaman dashboard
        header('Location: dashboard.php');  // Ubah sesuai dengan nama file dashboard Anda
        exit();
    }

    if (isset($_POST['login'])) {
      $login = login($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container">
      <h1 class="mt-5">Halaman Login</h1>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="text"
            name="email"
            class="form-control"
            id="email"
            placeholder="Masukkan Email"
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
          />
        </div>
        <button type="submit" name="login" class="btn btn-primary mb-3">Submit</button>
        <p>Belum Punya Akun? <a href="registrasi.php">Register</a></p>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
