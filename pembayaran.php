<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="./asset/css/pembayaran.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.0/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons@1.4.2/src/css/icons.css">
</head>
<body>
    <section id="header">
      <a href="#"><img src="" class="logo"  /></a>
      
      <div class="menu-icon" id="menu-icon">
        <i class="ph ph-list"></i>
      </div>

      <ul id="navbar">
        <li><a class="active" href="index.php#hero">Beranda</a></li>
        <li><a href="index.php#product1">Produk</a></li>
        <li><a href="index.php#carousel">Artikel</a></li>
        <li><a href="index.php#kontak">Kontak</a></li>
        <li><a href="keranjang.php"><i class="fa fa-shopping-bag"></i></a></li>
        <li><a href="#" id="btn_user"><i class="bi bi-person-circle"></i></a></li>
        <div class="user" id="user_menu">
            <li><a href="login.php">Login</a></li>
            <li><a href="pembayaran.php">Pembayaran</a></li>
            <li><a href="logout.php">Logout</a></li>
        </div>
      </ul>
    </section>
  
    <div class="container">
        <h2 class="mt-5">Pembayaran</h2>
        <table
          id="table"
          class="table"
          data-toggle="table"
          data-height="460"
          data-pagination="true"
          data-search="true">
          <thead>
            <tr>
              <th data-field="id">NO</th>
              <th data-field="nama_pelanggan">NAMA PELANGGAN</th>
              <th data-field="telepon_pelanggan">NOMER TELEPON</th>
              <th data-field="email_pelanggan">EMAIL PELANGGAN</th>
              <th data-field="total_harga">TOTAL HARGA</th>
              <th data-field="status">STATUS</th>
              <th data-field="hapus">HAPUS</th>
              <th data-field="bayar">BAYAR</th>
            </tr>
          </thead>
          <tbody>
            <?php  
            include "connection/connection.php";
            $no = 1;

            $query = mysqli_query($connection, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
            if (!$query) {
                echo "Error: " . mysqli_error($connection);
                exit();
            }

            while ($data = mysqli_fetch_array($query)) {
                $status = $data['total_harga'] > 0 ? 3 : 1; // Assuming a simple status logic based on total_harga

                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$data['nama_pelanggan']."</td>";
                echo "<td>".$data['telepon_pelanggan']."</td>";
                echo "<td>".$data['email_pelanggan']."</td>";
                echo "<td>".$data['total_harga']."</td>";

                if ($status >= 3) {
                    echo "<td><b>Pembayaran Sukses</b></td>";
                } elseif ($status >= 2) {
                    echo "<td><b>Pembayaran Pending</b></td>";
                } else {
                    echo "<td><b>Pembayaran Belum Dilakukan</b></td>";
                }

                echo "<td><a href='hapus.php?id=".$data['id_pelanggan']."' class='btn btn-danger'><i class='bi bi-trash-fill'></i> HAPUS</a></td>";
                echo "<td><a href='midtrans-php/examples/snap/checkout-process-simple-version.php?id=" . $data['id_pelanggan'] . "' class='btn btn-success'><i class='bi bi-credit-card-fill'></i> BAYAR</a></td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
    </div>

    <footer>
    <div class="footer-container">
        <div class="footer-column">
            <h2>Produk Daging</h2>
            <p>Rajungan Jumbo</p>
            <p>Capit Rajungan</p>
            <p>Capit Kepiting</p>
        </div>
        <div class="footer-column">
            <h2>Jelajahi </h2>
            <p><a style="text-decoration:none" href="#hero">Beranda</a></p>
            <p><a style="text-decoration:none" href="#product1">Produk</a></p>
            <p><a style="text-decoration:none" href="#carousel">Artikel</a></p>
            <p><a style="text-decoration:none" href="#kontak">Kontak</a></p>
        </div>
        <div class="footer-column">
            <h2>Tentang Kami</h2>
            <p>KP Kramat, Desa Sukawali, RT 001 RW 005, Kec. Pakuhaji, Kab. Tangerang</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p style="text-align: center;">©Website Rajungan 2024</p>
        <div class="footer-links">
        </div>
        <div class="footer-social">
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-whatsapp"></i></a>
        </div>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.0/bootstrap-table.min.js"></script>
    <script src="./asset/js/pembayaran.js"></script>
</body>
</html>
