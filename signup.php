<?php

if (isset($_POST['signup'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    // Debugging: Periksa input yang diterima
    error_log("Nama Lengkap: " . $nama_lengkap);
    error_log("Email: " . $email);
    error_log("Username: " . $username);
    error_log("Password (hashed): " . $password);

    // Insert data ke tabel account
    $sql = "INSERT INTO account (nama_lengkap, email, username, password) VALUES ('$nama_lengkap', '$email', '$username', '$password')";

    if ($connection->query($sql) === TRUE) {
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
                    title: 'Pendaftaran berhasil'
                }).then(() => {
                    window.location = 'login.php';
                });
              </script>";
    } else {
        error_log("Error: " . $sql . "\n" . $connection->error);
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
                    title: 'Pendaftaran gagal!!'
                }).then(() => {
                    window.location = 'signup.php';
                });
              </script>";
    }
}
?>
