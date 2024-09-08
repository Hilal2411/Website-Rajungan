<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan Rajungan</title>
    <link rel="stylesheet" href="../asset/css/styles.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons@1.4.2/src/css/icons.css">
  </head>
  <body>
    <section id="header">
      <a href="#"><img src="" class="logo"  /></a>
      
      <div class="menu-icon" id="menu-icon">
        <i class="ph ph-list"></i>
      </div>

      <?php
      session_start();

      // Cek apakah user sudah login
      $isLoggedIn = isset($_SESSION['id_role']); // Cek session 'id' yang diset saat login

      ?>

      <ul id="navbar">
          <li><a class="active" href="index.php#hero">Beranda</a></li>
          <li><a href="index.php#product1">Produk</a></li>
          <li><a href="index.php#carousel">Artikel</a></li>
          <li><a href="index.php#kontak">Kontak</a></li>
          <li><a href="keranjang.php"><i class="fa fa-shopping-bag"></i></a></li>
          <li><a href="#" id="btn_user"><i class="bi bi-person-circle"></i></a></li>
          <div class="user" id="user_menu">
              <?php if ($isLoggedIn): ?>
                  <!-- Jika user sudah login -->
                  <li><a href="pembayaran.php">Pembayaran</a></li>
                  <li><a href="logout.php">Logout</a></li>
              <?php else: ?>
                  <!-- Jika user belum login -->
                  <li><a href="login.php">Login</a></li>
              <?php endif; ?>
          </div>
      </ul>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="../asset/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
  </body>
</html>