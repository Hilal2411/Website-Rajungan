<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Kontak Pembeli</b></h5>
</div>

<?php

$kontak = array();
$ambil = $connection->query("SELECT * FROM kontak");
while($pecah = $ambil->fetch_assoc())
{
    $kontak[] = $pecah;
}
?>

<div class="card shadow bg-white">
    <div class="card-body">
    <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
               <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Opsi</th>
               </tr>
        </thead>
        <tbody>
            <?php foreach ($kontak as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['nama']; ?></td>
                    <td><?php echo $value['email']; ?></td>

                    <td class="text-center" width="150">
                        <a href="index.php?halaman=detail_pesan&id=<?php echo $value['id']; ?>" class="btn btn-sm btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_pesan&id=<?php echo $value['id'];?>" class="btn btn-sm btn-danger">Hapus</a>
                        
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</div>
