<?php 
session_start();
include '../connection/connection.php';

// Pengecekan apakah user sudah login atau belum
if(!isset($_SESSION['id_role'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Silahkan Login Terlebih Dahulu!!',
                showConfirmButton: false,
                timer: 1500,
                width: '500px', // ukuran diperkecil
                padding: '1rem', // padding diperkecil
                customClass: {
                    popup: 'small-swal-popup' // kelas khusus untuk styling
                }
            }).then(() => {
                window.location.href = '../login.php';
            });
        });
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rajungan Seafood</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    

    <!-- Custom styles for this template-->
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="../asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

     <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    

     


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Rajungan Seafood <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="ph ph-speedometer" style="font-size: 20px;"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=kategori">
                    <i class="ph ph-note-pencil" style="font-size: 20px;"></i>
                    <span>Kategori</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=pembelian">
                <i class="ph ph-shopping-cart" style="font-size: 20px;"></i>
                    <span>Pembelian</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=produk">
                <i class="ph ph-box-arrow-up" style="font-size: 20px;"></i>
                    <span>Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=pesan">
                <i class="ph ph-chat-circle-dots" style="font-size: 20px;"></i>
                    <span>Pesan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=pelanggan">
                <i class="ph ph-user-switch" style="font-size: 20px;"></i>
                    <span>Role akun</span></a>
            </li>


            <li class="nav-item">
            <a id="logout-link" class="nav-link" href="index.php?halaman=logout">
            <i class="ph ph-sign-out" style="font-size: 20px;"></i>
            <span>Logout</span>
             </a>
            </li>

    

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                        if (isset($_GET['halaman'])) {

                            if ($_GET['halaman'] == "dashboard") {
                                include 'dashboard.php';
                            }
                            // Halaman Kategori
                            elseif ($_GET['halaman'] == "kategori") {
                                include 'kategori.php';
                            }
                            elseif($_GET['halaman']=="tambah_kategori") {
                                include 'tambah_produk/tambah_kategori.php';
                            }
                            elseif ($_GET['halaman'] == "dashboard") {
                                include 'dashboard.php';
                            }
                            elseif($_GET['halaman'] =="edit_kategori")
                            {
                                include 'edit/edit_kategori.php';
                            }
                            elseif($_GET['halaman']=="hapus_kategori")
                            {
                                include 'hapus/hapus_kategori.php';
                            }


                            // Halaman Produk
                            elseif ($_GET['halaman'] == "produk") {
                                include 'produk.php';
                            }
                            elseif($_GET['halaman']== "tambah_produk") {
                                include 'tambah_produk/tambah_produk.php';
                            }
                            elseif($_GET['halaman']=="detail_produk") {  // Perbaiki di sini
                                include 'detail/detail_produk.php';
                            }
                            elseif($_GET['halaman']=="hapus_foto"){
                                include 'hapus/hapus_foto.php';
                            }
                            elseif($_GET['halaman']=="edit_produk")
                            {
                                include 'edit/edit_produk.php';
                            }
                            elseif($_GET['halaman']=="hapus_produk")
                            {
                                include 'hapus/hapus_produk.php';
                            }


                            // Halaman Pembelian
                            elseif ($_GET['halaman'] == "pembelian") {
                                include 'pembelian.php';
                            }
                            // Halaman Detail Pembelian
                            elseif ($_GET['halaman'] == "detail_pembelian") {
                                include 'detail/detail_pembelian.php';
                            }
                            elseif($_GET['halaman'] == "logout") {
                                include 'logout.php';
                                if(isset($_POST['logout'])) {
                                    // kode untuk logout
                                }
                            }

                           

                            // Halaman Kontak Pelanggan
                            elseif ($_GET['halaman'] == "pesan") {
                                include 'pesan.php';
                            }
                            elseif ($_GET['halaman'] == "detail_pesan") {
                                include 'detail/detail_pesan.php';
                            }
                            elseif ($_GET['halaman'] == "hapus_pesan") {
                                include 'hapus/hapus_pesan.php';
                            }


                            // Halaman Ubah Role
                            elseif ($_GET['halaman'] == "ubah_role") {
                                include 'edit/ubah_role.php';
                            }

                        } else {
                            include 'dashboard.php';
                        }
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button method="post" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../asset/vendor/jquery/jquery.min.js"></script>
    <script src="../asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asset/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../asset/js/demo/datatables-demo.js"></script>

    <!-- SweetAlert2 -->
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <script>
        $(document).ready(function(){
            $(".btn-tambah").on("click", function(){
                $(".input-foto").append("<input type='file' name='foto[]' class='form-control'>")
            })
        })

    </script>

</body>
</html>