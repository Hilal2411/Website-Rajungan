<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id_role'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit;
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
</head>
<body>
    <section id="header">
        <a href="#"><img src="" class="logo" alt="" /></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php#hero">Beranda</a></li>
                <li><a href="index.php#product1">Produk</a></li>
                <li><a href="index.php#carousel">Artikel</a></li>
                <li><a href="index.php#kontak">Kontak</a></li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
                <li><a href="keranjang.php"><i class="fa fa-shopping-bag"></i></a></li>
                <li><a href="login.php"><i class="bi bi-person-circle"></i></a></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="keranjang.php"><i class="fa fa-shopping-bag"></i></a>
            <i class="fa fa-outdent" id="bar"></i>
        </div>
    </section>

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
            <!-- Items will be dynamically added here -->
        </tbody>
    </table>

    <div id="cart-total" class="cart-total">Total: Rp0</div>
    <div id="cart-actions" class="cart-actions">
        <button id="openModalBtn" class="btn checkout-btn">Checkout</button>
    </div>
    
    <div id="checkoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Checkout</h2>
            <form id="checkoutForm">
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
                <div id="cart-total-modal" class="cart-total-modal">Total: Rp0</div>
                <button type="submit" class="btn submit-btn">Submit</button>
            </form>
        </div>
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
                <p><a style="text-decoration:none" href="index.php#hero">Beranda</a></p>
                <p><a style="text-decoration:none" href="index.php#product1">Produk</a></p>
                <p><a style="text-decoration:none" href="index.php#carousel">Artikel</a></p>
                <p><a style="text-decoration:none" href="index.php#kontak">Kontak</a></p>
            </div>
            <div class="footer-column">
                <h2>Tentang Kami</h2>
                <p>KP Kramat, Desa Sukawali, RT 001 RW 005, Kec. Pakuhaji, Kab. Tangerang</p>
                <p>Blog</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p style="text-align: center;">© Wisr 2021</p>
            <div class="footer-links"></div>
            <div class="footer-social">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./asset/js/keranjang.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
