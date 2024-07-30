<?php

$id_kategori = $_GET['id'];


$connection->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");

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
        window.location.href = 'index.php?halaman=kategori';
    }, 1500);
</script>";
?>