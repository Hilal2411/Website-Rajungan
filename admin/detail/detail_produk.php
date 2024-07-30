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
                <input disabled class="form-control" value="<?php echo $detailproduk['nama_kategori']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Produk :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo $detailproduk['nama_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga Produk:</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo $detailproduk['harga_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Berat Produk:</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo $detailproduk['berat_produk']?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Stok Produk:</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo $detailproduk['stok_produk']?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
<?php foreach ($produk_foto as $key => $value): ?>
    <div class="col-4">
        <div class="card" style="width: 22rem;">
            <img src="../asset/img/<?php echo $value['nama_produk_foto']; ?>" class="card-img-top img-thumbnail" alt="Product Image">
        </div>
        <div class="card-footer text-center">
            <a href="index.php?halaman=hapus_foto&idfoto=<?php echo $value['id_produk_foto'];?>&idproduk=<?php echo $value['id_produk']?>" class="btn btn-sm btn-danger">Hapus</a>
        </div>
    </div>
<?php endforeach; ?>
</div>


<form method="POST" enctype="multipart/form-data">
    <div class="card shadow bg-white">
        <div class="card-header">
            <strong>Tambah Foto</strong>
        </div>
        <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">File Foto :</label>
            <div class="col-sm-9">
                <input type="file" name="produk_foto" class="form-control">
            </div>
        </div>
        
        </div>
        
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


$id_produk = $_POST['id_produk'] ?? null; 
if (isset($_POST['simpan'])) {
    $namafoto = $_FILES['produk_foto']['name'];
    $lokasifoto = $_FILES['produk_foto']['tmp_name'];
    $tgl_foto = date('ymdHis') . $namafoto;
    
    // Ensure connection is established
    if ($connection) {
        // Check if the upload directory exists
        $upload_dir = "../asset/img/";
        if (!is_dir($upload_dir)) {
            echo "<script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Upload directory does not exist',
                    showConfirmButton: true
                });
            </script>";
            exit;
        }
        
        // Attempt to move the uploaded file
        if (move_uploaded_file($lokasifoto, $upload_dir . $tgl_foto)) {
            // Ensure $id_produk is set
            if (isset($id_produk)) {
                $query = "INSERT INTO produk_foto (id_produk, nama_produk) VALUES ('$id_produk', '$tgl_foto')";
                if ($connection->query($query)) {
                    echo "<script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Foto Anda berhasil disimpan',
                          showConfirmButton: false,
                          timer: 1500
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'error',
                          title: 'Database insert failed: " . $connection->error . "',
                          showConfirmButton: true
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: 'ID Produk not set',
                      showConfirmButton: true
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'File upload failed',
                  showConfirmButton: true
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Database connection failed',
              showConfirmButton: true
            });
        </script>";
    }
}
?>


