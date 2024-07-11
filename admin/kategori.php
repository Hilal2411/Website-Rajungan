<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Kategori</b></h5>
</div>

<?php

    $kategori = array();
    $ambil = $connection->query("SELECT * FROM kategori");
    while($pecah = $ambil->fetch_assoc() )
    {
        $kategori[] = $pecah;
    }

?>

<a href="index.php?halaman=tambah_kategori" class="btn btn-sm btn-success">Tambah Kategori</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($kategori as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key+1; ?></td>
                    <td ><?php echo $value['nama_kategori'];?></td>
                    <td class="text-center" width="155">
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>