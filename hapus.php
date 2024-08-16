<?php

include "connection/connection.php";

$id = $_GET['id'];

if (!is_numeric($id)) {
    echo "Invalid ID.";
    exit();
}

$connection->begin_transaction();

try {
    $query = "DELETE FROM pelanggan WHERE id_pelanggan=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $execute_pelanggan = $stmt->execute();
    
    $query2 = "DELETE FROM pembelian WHERE id_pelanggan=?";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("i", $id);
    $execute_pembelian = $stmt2->execute();
    
    if($execute_pelanggan && $execute_pembelian) {
        $connection->commit();
        header("location: pembayaran.php"); 
        exit();
    } else {
        $connection->rollback();
        echo "Data gagal dihapus. <a href='pembayaran.php'>Kembali</a>";
    }
} catch (Exception $e) {
    $connection->rollback();
    echo "Data gagal dihapus. <a href='pembayaran.php'>Kembali</a>";
}
?>