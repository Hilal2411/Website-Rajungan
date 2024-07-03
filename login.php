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
            <form>
                <input type="email" placeholder="password" required>
                <input type="password" placeholder="Password" required>
                <a href="#" onclick="showForgotPassword()">Forgot Password?</a>
                <button>Login</button>
                <p>Don't Have Account? <a href="#" onclick="toggleForms('signup')">Signup</a></p>
            </form>
        </div>
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
</body>
</html>
