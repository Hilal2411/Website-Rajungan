<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Tambah Produk</b></h5>
</div>



<?php 

$kategori = array();
$ambil = $connection->query("SELECT * FROM kategori");

while($pecah = $ambil->fetch_assoc())
{
    $kategori[]=$pecah;
}


?>

<form method="post" enctype="multipart/form-data">
    <div class="card shadow bg-white">
        <div class="card-body">

            <!-- Nama Kategori -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                <div class="col-sm-9">
                    <select name="id_kategori" class="form-control" required>
                        <option selected disabled>Pilih Nama Kategori</option>
                        <?php foreach($kategori as $key => $value):?>
                        <option value="<?php echo $value['id_kategori'];?>">
                            <?php echo $value['nama_kategori'];?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <!-- Nama Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Produk:</label>
                <div class="col-sm-9">
                   <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Produk" required>
                </div>
            </div>

            <!-- Harga Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga Produk :</label>
                <div class="col-sm-9">
                   <input type="number" name="harga" class="form-control" placeholder="Masukan Harga Produk" required>
                </div>
            </div>

            <!-- Berat Produk -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Berat Produk :</label>
                <div class="col-sm-9">
                   <input type="number" name="berat" class="form-control" placeholder="Masukan Berat Produk" required>
                </div>
            </div>

            <!-- Foto -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Foto :</label>
                <div class="col-sm-9">
                    <div class="input-foto">
                        <input type="file" name="foto[]" class="form-control" multiple>
                    </div>
                   <span class="btn btn-sm btn-success mt-3 btn-tambah">
                     <i class="fas fa-plus"></i>
                   </span>
                </div>
            </div>

            <!-- Stok Barang -->
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Stok Produk :</label>
                <div class="col-sm-9">
                   <input type="number" name="stok" class="form-control" placeholder="Masukan Stok Produk" required>
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

if (isset($_POST['simpan'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $stok = $_POST['stok'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];
    $error_foto = $_FILES['foto']['error'];

    // Pastikan direktori tujuan ada
    $uploadDir = "../asset/img/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Debugging untuk melihat isi $_FILES
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Debugging untuk melihat isi $_POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Debugging untuk melihat isi variabel $nama_foto dan $lokasi_foto
    echo "<pre>";
    echo "Nama Foto:<br>";
    print_r($nama_foto);
    echo "Lokasi Foto:<br>";
    print_r($lokasi_foto);
    echo "Error Foto:<br>";
    print_r($error_foto);
    echo "</pre>";

    // Upload file utama
    if ($error_foto[0] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($lokasi_foto[0], $uploadDir . $nama_foto[0])) {
            // Masukkan data produk ke database
            $query_produk = "INSERT INTO produk (id_kategori, nama_produk, harga_produk, berat_produk, foto_produk, stok_produk) 
            VALUES ('$id_kategori', '$nama', '$harga', '$berat', '$nama_foto[0]', '$stok')";
            if ($connection->query($query_produk) === TRUE) {
                $id_baru = $connection->insert_id;

                // Upload setiap foto tambahan
                for ($i = 1; $i < count($nama_foto); $i++) {
                    if ($error_foto[$i] === UPLOAD_ERR_OK) {
                        if (move_uploaded_file($lokasi_foto[$i], $uploadDir . $nama_foto[$i])) {
                            $query_foto = "INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id_baru', '" . $connection->real_escape_string($nama_foto[$i]) . "')";
                            echo "Executing query: $query_foto<br>"; // Debugging query
                            if ($connection->query($query_foto) === TRUE) {
                                echo "Foto tambahan berhasil diupload: $nama_foto[$i]<br>";
                            } else {
                                echo "Error inserting additional photo into database: " . $connection->error . "<br>";
                            }
                        } else {
                            echo "Gagal mengupload foto tambahan: $nama_foto[$i].<br>";
                        }
                    } else {
                        echo "Error uploading additional photo $nama_foto[$i]: " . $error_foto[$i] . "<br>";
                    }
                }
            } else {
                echo "Error inserting product into database: " . $connection->error . "<br>";
            }
        } else {
            echo "Gagal mengupload foto utama.";
        }
    } else {
        echo "Error uploading main photo: " . $error_foto[0];
    }
}
?>
