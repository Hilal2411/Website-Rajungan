<?php
 include 'include/navbar.php'; 


if (!isset($_SESSION['id_role'])) {
   
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan Rajungan</title>
    <link rel="stylesheet" href="./asset/css/keranjang.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons@1.4.2/src/css/icons.css">
    <!-- Midtrans -->
    <script type="text/javascript"
        src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-gWkcCKNmrZ3qMqIW"></script>

</head>
<body>
    <h1 style="text-align: center;">Keranjang Belanja</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="cart-body">
            
        </tbody>
    </table>

    <div id="cart-total" class="cart-total">Total: Rp0</div>
    <div id="cart-actions" class="cart-actions">
        <button id="openModalBtn" class="btn checkout-btn">Checkout</button>
    </div>
    
    <div id="checkoutModal" class="modal" action="pembayaran.php">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Checkout</h2>
        <form id="checkoutForm" method="POST">
            <div class="form-row">
                <!-- Left Column: Nama, Alamat, Nomor Telepon -->
                <div class="form-column-left">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <textarea id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>

                <!-- Right Column: Email, Tanggal, Jumlah Pembelian -->
                <div class="form-column-right">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Pembelian:</label>
                        <input type="number" id="jumlah" name="jumlah" required>
                    </div>
                </div>
            </div>

            <input type="hidden" id="total_harga" name="total_harga">
            <div id="cart-total-modal" class="cart-total-modal">Total: Rp0</div>
            <button type="submit" class="btn submit-btn">Submit</button>
        </form>
    </div>
</div>



<?php include 'include/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./asset/js/keranjang.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.1/dist/bootstrap-table.min.js"></script>
    
</body>
</html>

<?php
ob_start();

include 'connection/connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga']; 

    // Insert data into pelanggan table
    $sql_pelanggan = "INSERT INTO pelanggan (nama_pelanggan, telepon_pelanggan, email_pelanggan, alamat_pelanggan, total_harga) VALUES (?, ?, ?, ?, ?)";
    if ($stmt_pelanggan = $connection->prepare($sql_pelanggan)) {
        $stmt_pelanggan->bind_param("ssssi", $name, $phone, $email, $address, $total_harga);
        if (!$stmt_pelanggan->execute()) {
            echo "Error: Could not execute the query: " . $stmt_pelanggan->error;
            exit();
        }
        $id_pelanggan = $stmt_pelanggan->insert_id; // Get the ID of the inserted pelanggan record
        $stmt_pelanggan->close();
    } else {
        echo "Error: Could not prepare the query: " . $connection->error;
        exit();
    }

    // Insert data into pembelian table
    $tanggal_pembelian = $tanggal;
    $sql_pembelian = "INSERT INTO pembelian (id_pelanggan, tanggal_pembelian) VALUES (?, ?)";
    if ($stmt_pembelian = $connection->prepare($sql_pembelian)) {
        $stmt_pembelian->bind_param("is", $id_pelanggan, $tanggal_pembelian);
        if (!$stmt_pembelian->execute()) {
            echo "Error: Could not execute the query: " . $stmt_pembelian->error;
            exit();
        }
        $pembelian_id = $stmt_pembelian->insert_id; // Get the ID of the inserted pembelian record
        $stmt_pembelian->close();
    } else {
        echo "Error: Could not prepare the query: " . $connection->error;
        exit();
    }

    // Insert data into pembelian_produk table
    $sql_pembelian_produk = "INSERT INTO pembelian_produk (id_pembelian, jumlah) VALUES (?, ?)";
    if ($stmt_pembelian_produk = $connection->prepare($sql_pembelian_produk)) {
        $stmt_pembelian_produk->bind_param("ii", $pembelian_id, $jumlah);
        if (!$stmt_pembelian_produk->execute()) {
            echo "Error: Could not execute the query: " . $stmt_pembelian_produk->error;
            exit();
        }
        $stmt_pembelian_produk->close();
    } else {
        echo "Error: Could not prepare the query: " . $connection->error;
        exit();
    }

   
    $connection->close();

   
    ob_end_flush();
    
    // JavaScript to redirect the user to pembayaran.php
    echo '<script type="text/javascript">
            window.onload = function() {
                window.location.href = "pembayaran.php";
            };
          </script>';
    exit();
}
?>