<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Detail Produk</b></h5>
</div>

<?php
$id_produk = $_GET['id'];

// Mengecek koneksi
if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}

$ambil = $connection->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$id_produk'");

// Mengecek apakah query berhasil
if (!$ambil) {
    die("Query Error: " . $connection->error);
}

$detailproduk = $ambil->fetch_assoc();

$produk_foto = array();
$ambil = $connection->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");

// Mengecek apakah query berhasil
if (!$ambil) {
    die("Query Error: " . $connection->error);
}

while ($tiap = $ambil->fetch_assoc()) {
    $produk_foto[] = $tiap;
}
?>

<div class="card shadow bg-white"><div  class="card-header">
    <strong>Data Produk</strong>
</div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Kategori :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" placeholder="<?php echo $detailproduk['nama_kategori']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Produk :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" placeholder="<?php echo $detailproduk['nama_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" placeholder="<?php echo $detailproduk['harga_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Berat Kategori :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" placeholder="<?php echo $detailproduk['berat_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Stok Kategori :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" placeholder="<?php echo $detailproduk['stok_produk']?>">
            </div>
        </div>
    </div>
</div>
