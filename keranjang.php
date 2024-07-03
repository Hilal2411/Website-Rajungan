<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="./asset/css/keranjang.css">
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
            <!-- Items will be dynamically added here -->
        </tbody>
    </table>

    <div id="cart-total" class="cart-total">Total: Rp0</div>
    <div id="cart-actions" class="cart-actions">
        <button id="openModalBtn" class=" btn checkout-btn">Checkout</button>
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
    
    <script src="./asset/js/keranjang.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
