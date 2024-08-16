<?php

include('connection/connection.php'); // Include connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['Name'];
    $email = $_POST['Email'];
    $no_hp = $_POST['phone_number']; // Use a key without spaces
    $pesan = $_POST['Message'];

    // Ensure your table has an email column
    $sql = "INSERT INTO kontak (nama, email, no_hp, pesan)
            VALUES ('$nama', '$email', '$no_hp', '$pesan')";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        // SweetAlert2 Popup for Success
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data berhasil dikirim!',
                showConfirmButton: false,
                timer: 1500,
                width: '400px', // ukuran diperkecil
                padding: '1rem', // padding diperkecil
                customClass: {
                    popup: 'small-swal-popup' // kelas khusus untuk styling
                }
            }).then(() => {
                window.location.href = 'index.php'; // Redirect to the index page
            });
        });
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close the connection
$connection->close();
?>