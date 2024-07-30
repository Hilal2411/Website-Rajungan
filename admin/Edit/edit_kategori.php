<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Edit Kategori</b></h5>
</div>

<?php

$id_kategori = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_kategori) {
    $ambil = $connection->query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");
    
    if ($ambil && $ambil->num_rows > 0) {
        $edit = $ambil->fetch_assoc();
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ID Kategori tidak ditemukan',
                showConfirmButton: true
            });
            window.location.href = 'index.php?halaman=kategori';
        </script>";
        exit();
    }
} else {
    echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ID Kategori tidak diberikan',
            showConfirmButton: true
        });
        window.location.href = 'index.php?halaman=kategori';
    </script>";
    exit();
}
?>

<form method="post">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Kategori :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($edit['nama_kategori']); ?>" required>
                </div>
            </div> 
            <!-- Hidden field for id_kategori -->
            <input type="hidden" name="id_kategori" value="<?php echo htmlspecialchars($edit['id_kategori']); ?>">

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="index.php?halaman=kategori" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
if (isset($_POST['simpan'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    // Pastikan variabel POST telah didefinisikan dan tidak null
    if (isset($_POST['nama']) && isset($_POST['id_kategori'])) {
        $nama = $_POST['nama'];
        $id_kategori = $_POST['id_kategori'];

        if ($connection->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id_kategori'")) {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => {
                    window.location.href = 'index.php?halaman=edit_kategori&id=$id_kategori';
                }, 1500);
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Update failed',
                    showConfirmButton: true
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ID Kategori or Nama is missing',
                showConfirmButton: true
            });
        </script>";
    }
}
?>
