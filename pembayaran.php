<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.0/bootstrap-table.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Pembayaran</h2>
        <table
          id="table"
          class="table"
          data-toggle="table"
          data-height="460"
          data-pagination="true"
          data-search="true">
          <thead>
            <tr>
              <th data-field="id">NO</th>
              <th data-field="nama_pelanggan">NAMA PELANGGAN</th>
              <th data-field="telepon_pelanggan">NOMER TELEPON</th>
              <th data-field="email_pelanggan">EMAIL PELANGGAN</th>
              <th data-field="total_harga">TOTAL HARGA</th>
              <th data-field="status">STATUS</th>
              <th data-field="hapus">HAPUS</th>
              <th data-field="bayar">BAYAR</th>
            </tr>
          </thead>
          <tbody>
            <?php  
            include "connection/connection.php";
            $no = 1;

            $query = mysqli_query($connection, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
            if (!$query) {
                echo "Error: " . mysqli_error($connection);
                exit();
            }

            while ($data = mysqli_fetch_array($query)) {
                $status = $data['total_harga'] > 0 ? 3 : 1; // Assuming a simple status logic based on total_harga

                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$data['nama_pelanggan']."</td>";
                echo "<td>".$data['telepon_pelanggan']."</td>";
                echo "<td>".$data['email_pelanggan']."</td>";
                echo "<td>".$data['total_harga']."</td>";

                if ($status >= 3) {
                    echo "<td><b>Pembayaran Sukses</b></td>";
                } elseif ($status >= 2) {
                    echo "<td><b>Pembayaran Pending</b></td>";
                } else {
                    echo "<td><b>Pembayaran Belum Dilakukan</b></td>";
                }

                echo "<td><a href='hapus.php?id=".$data['id_pelanggan']."' class='btn btn-danger'><i class='bi bi-trash-fill'></i> HAPUS</a></td>";
                echo "<td><a href='midtrans-php/examples/snap/checkout-process-simple-version.php?id=" . $data['id_pelanggan'] . "' class='btn btn-success'><i class='bi bi-credit-card-fill'></i> BAYAR</a></td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.0/bootstrap-table.min.js"></script>
</body>
</html>
