<?php
// Include database connection


// Get the ID from the URL and validate it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the ID is valid
if ($id > 0) {
    // Prepare the SQL statement using prepared statements
    $stmt = $connection->prepare("DELETE FROM kontak WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data Berhasil Dihapus',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(() => {
                window.location.href = 'index.php?halaman=pesan';
            }, 1500);
        </script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<script>alert('ID tidak valid.');</script>";
}

// Close the database connection
$connection->close();
?>
