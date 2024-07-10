<?php 
    session_start();
    include './connection/connection.php';
?>

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
                <h2>Your Name</h2>
                <p>Place Sub Name</p>
            </div>
            <form>
                <input type="text" placeholder="User Name" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <button>Signup</button>
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
</body>
</html>
<?php

if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = sha1($_POST['pass']);

    $ambil = $connection->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    $akun = $ambil->num_rows;

    if($akun == 1) {
        $_SESSION['admin'] = $ambil->fetch_assoc();
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
                    window.location = './admin/index.php';
                });
              </script>";
    } else {
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
                    icon: 'error',
                    title: 'Login gagal!!'
                }).then(() => {
                    window.location = 'login.php';
                });
              </script>";
    }
}

?>


