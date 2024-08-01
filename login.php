<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login, Signup, and Forgot Password</title>
    <link rel="stylesheet" href="./asset/css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-container login-container" id="login-container">
            <div class="header">
                <img src="./asset/img/Logo.png" alt="Logo">
                <h2>Rajungan Seafood</h2>
            </div>
            <!-- Menu Login -->
            <form method="post" class="user">
                <input type="text" name="user" placeholder="username" >
                <input type="password" name="pass" placeholder="Password" required>
                <a href="#" onclick="showForgotPassword()">Forgot Password?</a>
                <button type="submit" name="login">Login</button>
                <p>Don't Have Account? <a href="#" onclick="toggleForms('signup')">Signup</a></p>
            </form>
        </div>
        <!-- Menu Sign in -->
        <div class="form-container signup-container" id="signup-container" style="display: none;">
            <div class="header">
                <img src="./asset/img/Logo.png" alt="Logo">
                <h2>Registrasi</h2>
            </div>
            <form method="post">
                <input type="text" name="username" placeholder="User Name" required>
                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="signup">Signup</button>
                <p>Already Have Account? <a href="#" onclick="toggleForms('login')">Login</a></p>
            </form>

        </div>
        <!-- Menu Forget Akun -->
        <div class="form-container forgot-password-container" id="forgot-password-container" style="display: none;">
            <div class="header">
                <img src="./asset/img/Logo.png" alt="Logo">
                <h2>Your Name</h2>
                <p>Place Sub Name</p>
            </div>
            <form>
                <input type="text" placeholder="Mobile Number" required>
                <button>Reset Password</button>
                <p>Remembered? <a href="#" onclick="toggleForms('login')">Login</a></p>
            </form>
        </div>
    </div>
    <script src="./asset/js/login.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="./asset/vendor/jquery/jquery.min.js"></script>
    <script src="./asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="./asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../asset/js/sb-admin-2.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.notiflix.com/notiflix-3.2.6.min.css" />

    <script src="https://cdn.notiflix.com/notiflix-3.2.6.min.js"></script>

</body>
</html>


<?php
include('connection/connection.php'); // Menggunakan path relatif yang benar
session_start();

if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = sha1($_POST['pass']);

    // Debugging: Periksa input yang diterima
    error_log("User: " . $user);
    error_log("Password (hashed): " . $pass);

    // Jalankan query
    $ambil = $connection->query("SELECT * FROM account WHERE username='$user' AND password='$pass'");

    // Periksa apakah query berhasil
    if (!$ambil) {
        die("Query gagal: " . $connection->error);
    }

    $akun = $ambil->num_rows;

    // Debugging: Periksa jumlah baris yang ditemukan
    error_log("Jumlah akun ditemukan: " . $akun);

    if($akun == 1) {
        $user_data = $ambil->fetch_assoc();

        // Debugging: Periksa data yang diambil dari database
        error_log("Data user: " . print_r($user_data, true));

        // Pastikan kolom 'id_role' ada
        if (isset($user_data['id_role'])) {
            $_SESSION['id_role'] = $user_data['id_role'];

            // Debugging: Periksa id_role yang diambil
            error_log("User id_role: " . $user_data['id_role']);

            if ($user_data['id_role'] == 1) {
                $redirect_url = './admin/index.php';
            } else {
                $redirect_url = './keranjang.php';
            }

            echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Anda telah berhasil login'
                    }).then(() => {
                        window.location = '$redirect_url';
                    });
                  </script>";
        } else {
            // Jika kolom 'id_role' tidak ditemukan
            error_log("Error: Kolom 'id_role' tidak ditemukan di tabel database.");
            echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Login gagal: Role tidak ditemukan'
                    }).then(() => {
                        window.location = 'login.php';
                    });
                  </script>";
        }
    } else {
        echo "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'error',
                    title: 'Login gagal!!'
                }).then(() => {
                    window.location = 'login.php';
                });
              </script>";
    }
}

if(isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']); // Mengenkripsi password dengan sha1
    $nama_lengkap = $_POST['nama_lengkap']; // Ambil nama lengkap dari form

    // Periksa apakah username sudah digunakan
    $cek_user = $connection->query("SELECT * FROM account WHERE username='$username'");
    
    if ($cek_user->num_rows > 0) {
        // Username sudah ada
        echo "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'error',
                    title: 'Username sudah digunakan'
                });
              </script>";
    } else {
        // Insert data ke database
        $insert = $connection->query("INSERT INTO account (username, password, nama_lengkap, id_role) VALUES ('$username', '$password', '$nama_lengkap', 2)");

        if ($insert) {
            // Berhasil insert data
            echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Akun Anda telah dibuat'
                    }).then(() => {
                        window.location = 'login.php';
                    });
                  </script>";
        } else {
            // Gagal insert data
            echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan, coba lagi nanti'
                    });
                  </script>";
        }
    }
}





?>