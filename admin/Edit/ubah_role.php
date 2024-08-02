<?php
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
include '../../connection/connection.php';

// Mengatur header untuk JSON
header('Content-Type: application/json');

// Memeriksa apakah parameter 'id' dan 'role' ada di URL
if (isset($_GET['id']) && isset($_GET['role'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];

    // Sanitasi input untuk mencegah SQL Injection
    $id = $connection->real_escape_string($id);
    $role = $connection->real_escape_string($role);

    // Memeriksa apakah role yang diterima valid (1 untuk Admin, 2 untuk Pembeli)
    if ($role == 1 || $role == 2) {
        // Query untuk mengubah role berdasarkan ID
        $query = "UPDATE account SET id_role = '$role' WHERE id_admin = '$id'";
        
        // Eksekusi query
        if ($connection->query($query) === TRUE) {
            // Kembalikan respons JSON
            echo json_encode(['status' => 'success']);
        } else {
            // Kembalikan respons JSON dengan pesan error
            echo json_encode([
                'status' => 'error',
                'message' => 'Database query failed.',
                'error' => $connection->error // Tampilkan kesalahan query SQL
            ]);
        }
    } else {
        // Kembalikan respons JSON jika role tidak valid
        echo json_encode(['status' => 'error', 'message' => 'Invalid role.']);
    }
} else {
    // Kembalikan respons JSON jika parameter tidak lengkap
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters.']);
}

// Pastikan tidak ada output lain setelah JSON
exit;
?>
