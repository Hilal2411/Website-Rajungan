<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Edit Produk</b></h5>
</div>

<?php 

$id_produk = $_GET['id'];

$kategori = array();
$ambil = $connection->query("SELECT * FROM kategori");
while($pecah = $ambil->fetch_assoc())
{
    $kategori[] = $pecah;
}

$ambil = $connection->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$id_produk'");
$edit = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                <div class="col-sm-9">
                  <select name="id_kategori" class="form-control">
                        <option value="<?php echo htmlspecialchars($edit['id_kategori']); ?>">
                            <?php echo htmlspecialchars($edit['nama_kategori']); ?>
                        </option>

                        <?php foreach ($kategori as $key => $value): ?>
                        <option value="<?php echo htmlspecialchars($value['id_kategori']); ?>">
                            <?php echo htmlspecialchars($value['nama_kategori']); ?>
                        </option>
                        <?php endforeach?>
                  </select>
                </div>
            </div>     

            <!-- Nama Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($edit['nama_produk']); ?>">
                </div>
            </div>

            <!-- Harga Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="harga" class="form-control" value="<?php echo htmlspecialchars($edit['harga_produk']); ?>">
                </div>
            </div>
            

            <!-- Berat Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Berat Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="berat" class="form-control" value="<?php echo htmlspecialchars($edit['berat_produk']); ?>">
                </div>
            </div>

            <!-- Foto Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Foto Produk :</label>
                <div class="col-sm-9">
                    <img src="../asset/img/<?php echo htmlspecialchars($edit['foto_produk']); ?>" width="150">
                    <input type="file" name="foto[]" class="form-control">
                </div>
            </div>

            <!-- Stok Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Stok Produk :</label>
                <div class="col-sm-9">
                    <input type="text" name="stok" class="form-control" value="<?php echo htmlspecialchars($edit['stok_produk']); ?>">
                </div>
            </div>

            <!-- Hidden field for id_produk -->
            <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($edit['id_produk']); ?>">

        </div>
        <!-- Button Simpan -->
        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <button name="simpan" class="btn btn-sm btn-success">Simpan</button>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=produk" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php

if (isset($_POST['simpan']))
{
    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $stok = $_POST['stok'];
    $id_produk = $_POST['id_produk']; // pastikan id_produk didefinisikan

    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    // jika foto produk diubah
    if (!empty($lokasifoto[0]))
    {
        move_uploaded_file($lokasifoto[0], "../asset/img/" . $namafoto[0]);

        $connection->query("UPDATE produk SET 
            id_kategori = '$id_kategori',
            nama_produk = '$nama',
            harga_produk = '$harga',
            berat_produk = '$berat',
            foto_produk = '$namafoto[0]',
            stok_produk = '$stok'
            WHERE id_produk = '$id_produk'
        ");
    }
    // Jika foto produk tidak diubah
    else 
    {
        $connection->query("UPDATE produk SET 
            id_kategori = '$id_kategori',
            nama_produk = '$nama',
            harga_produk = '$harga',
            berat_produk = '$berat',
            stok_produk = '$stok'
            WHERE id_produk = '$id_produk'
        ");
    }

    // Menambahkan foto baru ke tabel produk_foto
    for ($i = 0; $i < count($namafoto); $i++) {
        if (!empty($lokasifoto[$i])) {
            move_uploaded_file($lokasifoto[$i], "../asset/img/" . $namafoto[$i]);
            $connection->query("INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id_produk', '$namafoto[$i]')");
        }
    }

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Produk berhasil diupdate',
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(() => {
            window.location.href = 'index.php?halaman=produk';
        }, 1500);
    </script>";
}
?>
