<?php

    $kategori = array();
    $ambil = $connection->query("SELECT * FROM kategori");
    while($pecah = $ambil->fetch_assoc() )
    {
        $kategori[] = $pecah;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch; 
        }
    </style>
</head>
<body>
<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Kategori</b></h5>
</div>

<a href="index.php?halaman=tambah_kategori" class="btn btn-sm btn-success">Tambah Kategori</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
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
                            <a href="index.php?halaman=edit_kategori&id=<?php echo $value['id_kategori'];?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="index.php?halaman=hapus_kategori&id=<?php echo $value['id_kategori'];?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>