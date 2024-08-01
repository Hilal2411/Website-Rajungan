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
                    <th>Id Role</th>
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
                        if($row['id_role'] == 1) {
                            echo "<a class='btn btn-sm btn-info'>Admin</a>";
                        } elseif($row['id_role'] == 2) {
                            echo "<a class='btn btn-sm btn-primary'>Penjual</a>";
                        } else {
                            echo "<a class='btn btn-sm btn-secondary'>Pembeli</a>";
                        }
                        
                        echo "</td>";
                        echo "<td>".$row['id_role']."</td>";
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
