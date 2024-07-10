<?php
// session_start();
session_destroy();
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Anda Berhasil Logout!!!',
        showConfirmButton: false,
        timer: 1000,
        width: '400px', // ukuran diperkecil
        padding: '1rem', // padding diperkecil
        customClass: {
            popup: 'small-swal-popup' // kelas khusus untuk styling
        }
    }).then(() => {
        window.location.href = '../login.php';
    });
});
</script>";
?>



