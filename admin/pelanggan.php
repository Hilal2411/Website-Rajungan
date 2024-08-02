<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Role Akun</b></h5>
</div>

<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama </th>
                    <th>Username </th>
                    <th>Role</th>
                    <th>Opsi</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data dari tabel 'account'
                $query = "SELECT * FROM account";
                $result = $connection->query($query);
                
                if ($result->num_rows > 0) {
                    $no = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td width='50'>".$no."</td>";
                        echo "<td>".$row['nama_lengkap']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td class='text-center' width='150'>";
                        if ($row['id_role'] == 1) {
                            echo "<span style='background-color: #54E346; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;'>Admin</span>";
                        } elseif ($row['id_role'] == 2) {
                            echo "<span style='background-color: #37B7C3; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;'>Pembeli</span>";
                        } else {
                            echo "<span style='background-color: blue; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;'>Tidak diketahui</span>";
                        }
                        echo "</td>";
                        echo "<td class='text-center' width='150'>";
                        echo "<button class='btn btn-sm btn-success btn-change-role' data-id='".$row['id_admin']."' data-role='1'>Jadikan Admin</button> ";
                        echo "<button class='btn btn-sm btn-primary btn-change-role' data-id='".$row['id_admin']."' data-role='2'>Jadikan Pembeli</button>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data yang tersedia</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-change-role').on('click', function() {
        var id = $(this).data('id');
        var role = $(this).data('role');

        $.ajax({
    url: './Edit/ubah_role.php', // Pastikan path ini benar
    type: 'GET',
    dataType: 'json',
    data: { id: id, role: role },
    success: function(response) {
        console.log(response); // Tambahkan ini untuk debug
        if (response.status === 'success') {
            alert('Role berhasil diubah!');
            location.reload(); // Reload halaman untuk melihat perubahan
        } else {
            alert('Terjadi kesalahan: ' + response.message);
        }
    },
    error: function(xhr, status, error) {
        console.log(xhr.responseText); // Tambahkan ini untuk debug
        alert('Terjadi kesalahan: ' + error);
    }
});

    });
});
</script>