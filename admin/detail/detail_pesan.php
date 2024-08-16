<?php
// Koneksi ke database
include '../connection/connection.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan data berdasarkan ID
$query = "SELECT * FROM kontak WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Ambil data jika ditemukan
$detail = $result->fetch_assoc();

// Tutup koneksi
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesan</title>
    <link rel="stylesheet" href="path/to/your/css/style.css">
</head>
<body>
    <div class="shadow p-3 mb-3 bg-white rounded"> 
        <h5><b>Halaman Detail Pesan</b></h5>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Pembeli</strong>
                </div>
                <div class="card-body row">
                    <!-- Nama -->
                    <label class="col-md-4 col-form-label">Nama :</label>
                    <label class="col-md-8 col-form-label"><?php echo htmlspecialchars($detail['nama']); ?></label>
                    <!-- Email -->
                    <label class="col-md-4 col-form-label">Email :</label>
                    <label class="col-md-8 col-form-label"><?php echo htmlspecialchars($detail['email']); ?></label>
                    <!-- Nomer Telepon -->
                    <label class="col-md-4 col-form-label">No HP :</label>
                    <label class="col-md-8 col-form-label"><?php echo htmlspecialchars($detail['no_hp']); ?></label>

                    <label class="col-md-4 col-form-label">Pesan :</label>
                    <label class="col-md-8 col-form-label"><?php echo htmlspecialchars($detail['pesan']); ?></label>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
