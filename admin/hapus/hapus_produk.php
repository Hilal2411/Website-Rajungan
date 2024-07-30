<?php

$id_produk = $_GET['id'];

$ambil = $connection -> query("SELECT * FROM produk WHERE id_produk='$id_produk'");

$pecah = $ambil->fetch_assoc();


$hapus_foto = $pecah['foto_produk'];

if(file_exists("../asset/img/". $hapus_foto));
{
    unlink("../asset/img/". $hapus_foto);
}

$connection->query("DELETE FROM produk WHERE id_produk='$id_produk'");

$hapusprodukfoto = array();
$ambil = $connection->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");

while($hapus = $ambil->fetch_assoc())
{
    $hapusprodukfoto[] = $hapus;
}

foreach ($hapusprodukfoto as $key => $value)
{
    $hapusfoto = $value['nama_produk_foto'];

    if(file_exists("../asset/img/". $hapusfoto));
    {
        unlink("../asset/img/" . $hapusfoto);
    }

    $connection->query("DELETE FROM produk_foto WHERE id_produk='$id_produk'");

}

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
        window.location.href = 'index.php?halaman=produk';
    }, 1500);
</script>";



?>