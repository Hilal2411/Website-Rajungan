<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Pembelian</b></h5>
</div>

<?php

$pembelian = array();
$ambil = $connection->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");

while($pecah = $ambil->fetch_assoc())
{
    $pembelian[] = $pecah;
}
?>

<div class=" card shadow bg-white">
    <div class="card-body">
    <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
               <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Opsi</th>
                    
               </tr>
        </thead>
        <tbody>
            <?php foreach ($pembelian as $key => $value):?>
                <tr>
                    <th width="50"><?php echo $key+1; ?></th>
                    <th><?php echo $value['nama_pelanggan']; ?></th>
                    <th><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></th>
                    <th>Rp<?php echo number_format($value['total_pembelian']); ?></th>
                    <th class="text-center" width="150">
                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                        
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</div>