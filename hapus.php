<?php
// Load file koneksi.php
include "connection/connection.php";

// Ambil data id yang dikirim oleh halaman sebelumnya melalui URL
$id = $_GET['id'];

// Validate the id
if (!is_numeric($id)) {
    echo "Invalid ID.";
    exit();
}

// Start a transaction
$connection->begin_transaction();

try {
    // Query untuk menghapus data dari table pelanggan
    $query = "DELETE FROM pelanggan WHERE id_pelanggan=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $execute_pelanggan = $stmt->execute();
    
    // Query untuk menghapus data dari table pembelian
    $query2 = "DELETE FROM pembelian WHERE id_pelanggan=?";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("i", $id);
    $execute_pembelian = $stmt2->execute();
    
    // Commit the transaction if both queries succeeded
    if($execute_pelanggan && $execute_pembelian) {
        $connection->commit();
        // Jika Sukses, Lakukan :
        header("location: pembayaran.php"); // Redirect ke halaman pembayaran.php
        exit();
    } else {
        // If either query failed, rollback the transaction
        $connection->rollback();
        echo "Data gagal dihapus. <a href='pembayaran.php'>Kembali</a>";
    }
} catch (Exception $e) {
    // An exception has occurred, rollback the transaction
    $connection->rollback();
    echo "Data gagal dihapus. <a href='pembayaran.php'>Kembali</a>";
}
?>