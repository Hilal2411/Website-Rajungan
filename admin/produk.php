<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Produk</b></h5>
</div>

<?php

$produk = array();
$ambil = $connection->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori");

while($pecah = $ambil->fetch_assoc())
{
    $produk[] = $pecah;
}

?>

<a href="index.php?halaman=tambah_produk" class="btn btn-sm btn-success">Tambah Produk</a>

<div class=" card shadow bg-white mt-3">
    <div class="card-body">
    <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
               <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Foto</th>
                    <th>Opsi</th>
               </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $key => $value):?>
            <tr>
                <td width="50"><?php echo $key+1; ?></td>
                <td><?php echo $value['nama_kategori']; ?> </td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td>Rp<?php echo number_format($value['harga_produk']); ?></td>
                <td><?php echo number_format($value['berat_produk']); ?>Gr</td>
                <!-- Foto -->
                <td>
                    <?php $imagePath = "../asset/img/" . $value['foto_produk']; ?>
                        <img width="150" src="<?php echo $imagePath; ?>" alt="">
                </td>
                <td class="text-center" width="150">
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</div>