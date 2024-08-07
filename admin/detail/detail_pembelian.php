<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Detail Pembelian</b></h5>
</div>


<?php
    // include '../connection/connection.php';
    $id_pembelian = $_GET['id'];

    // memanggil data pembelian
    $ambil = $connection->query("SELECT * FROM pembelian 
    JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
    WHERE pembelian.id_pembelian = '$id_pembelian'");

    if ($ambil) {
        $detail = $ambil->fetch_assoc();
        // Tampilkan detail pembelian di sini
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
    } else {
        echo "Error: " . $connection->error;
    }
?>

<div class="row">

    <div class="col-md-4">
        <div class="card shadow bg-white">
            <div class="card-header">
                <strong>Data Pelanggan</strong>
            </div>
            <div class="card-body row">
            <!-- Nama -->
            <label class="col-md-4 col-form-label">Nama :</label>
            <label class="col-md-8 col-form-label"><?php echo $detail['nama_pelanggan']?></label>
            <!-- Email -->
            <label class="col-md-4 col-form-label">email :</label>
            <label class="col-md-8 col-form-label"><?php echo $detail['email_pelanggan']?></label>
            <!-- Nomer Telepon -->
            <label class="col-md-4 col-form-label">Telepon :</label>
            <label class="col-md-8 col-form-label"><?php echo $detail['telepon_pelanggan']?></label>

            <label class="col-md-4 col-form-label">Alamat :</label>
            <label class="col-md-8 col-form-label"><?php echo $detail['alamat_pelanggan']?></label>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow bg-white">
            <div class="card-header">
                <strong>Data Pembelian</strong>
            </div>
            <div class="card-body row">
            <!-- Tanggal  -->
            <label class="col-md-4 col-form-label">Tanggal :</label>
            <label class="col-md-8 col-form-label"><?php echo date("d F Y", strtotime($detail['tanggal_pembelian']))?></label>

            <!-- Total -->
            <label class="col-md-4 col-form-label">Total :</label>
            <label class="col-md-8 col-form-label">Rp. <?php echo number_format($detail['total_harga'])?></label>
            </div>
            </div>
            </div>
        </div>
    </div>

    <?php
    $pembelian_produk = array();
    $ambil = $connection->query("SELECT *FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");
    while($pecah = $ambil->fetch_assoc())
    {
        $pembelian_produk[] = $pecah;
    }
    ?>

    <div class="card shadow bgg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembelian_produk as $key => $value): ?>
                    <?php  $subtotal = $value['harga_produk']*$value['jumlah'];?>
                    <tr>
                        <td width="50"> <?php echo $key=1;?></td>
                        <td> <?php echo $value['nama_produk']; ?></td>
                        <td> Rp. <?php echo number_format($value['harga_produk']); ?></td>
                        <td><?php echo $value['jumlah']; ?></td>
                        <td>Rp. <?php echo number_format($subtotal); ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
