<?php
$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_foto = $_POST['id_foto'];
    
    $ambil = $connection->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto'");
    $detailfoto = $ambil->fetch_assoc();
    $nama_foto = $detailfoto['nama_produk_foto'];
    
    if (unlink("../asset/img/" . $nama_foto)) {
        $connection->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");
        echo "<script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'index.php?halaman=produk';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto Berhasil Dihapus',
                showConfirmButton: true
            });
            .then(() => {
              window.location.href = 'index.php?halaman=produk';
            });
        </script>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Photo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to the PHP script
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", window.location.href, true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.body.innerHTML = xhr.responseText;
                        }
                    };
                    xhr.send("id_foto=" + encodeURIComponent("<?php echo $id_foto; ?>"));
                } else {
                    window.location.href = 'index.php?halaman=detail_produk&id=23'; // Redirect if user cancels
                }
            });
        });
    </script>
</body>
</html>
