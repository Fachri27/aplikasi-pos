<?php 
session_start();

include 'library/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: index.php");
}

$barang = mysqli_query($conn, "SELECT * FROM tbl_barang");
$dataBar = mysqli_num_rows($barang);

//PAGINATION
$username = $_SESSION['username'];
$jumlalahPerHalaman = 5;
$jumlahData = mysqli_query($conn, "SELECT tbl_penjualan.*, tbl_barang.*, tbl_penjualan_item.* 
                                   FROM tbl_penjualan_item 
                                   INNER JOIN tbl_barang ON tbl_penjualan_item.id_barang=tbl_barang.id_barang 
                                   INNER JOIN tbl_penjualan ON tbl_penjualan_item.no_penjualan=tbl_penjualan.no_penjualan
                                   WHERE tbl_penjualan.username='$username'");
$cek = mysqli_num_rows($jumlahData);
$jumlahHalaman = ceil($cek / $jumlalahPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlalahPerHalaman * $halamanAktif) - $jumlalahPerHalaman;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Kasir</title>

    <!-- Custom fonts for this template-->
    <link href="assets/tamplate/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/tamplate/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/tamplate/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" >


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4E31AA">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Yups Mart</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dash-kasir.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                INTERFACE
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="kasir-barang.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Barang</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="pages/transaksi/form-trans.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                    <img src="img/img4.png" width="45" height="40">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama_lengkap']?></span>
                                <img class="img-profile rounded-circle"
                                    src="pages/users/gambar/<?= $_SESSION['foto'] ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row animate__animated animate__slideInLeft animate__slow 0.5s">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="kasir-barang.php">Data Barang</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dataBar ?></div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="pages/transaksi/form-trans.php">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Transaksi</div></a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <!-- Content Row -->

                    <div class="row animate__animated animate__slideInLeft animate__slow 0.5s">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">LAPORAN PENJUALAN-KASIR <?= $_SESSION['username'] ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <nav aria-label="...">
                                          <ul class="pagination">
                                            <li class="page-item disabled">
                                              <span class="page-link">Previous</span>
                                            </li>
                                            <?php for($i = 1; $i<=$jumlahHalaman; $i++): ?>
                                                <?php if($i == $halamanAktif): ?>
                                                    <li class="page-item active" aria-current="page">
                                                      <a href = "?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                                                <?php else : ?>
                                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                <?php endif ; ?>
                                            <?php endfor ; ?>
                                            </li>
                                          </ul>
                                        </nav>
                                        <table class="table table-bordered font-weight-bold" id="dataTable" width="100%" cellspacing="0" border="2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>No Penjualan</th>
                                                    <th>Nama Barang</th>
                                                    <th>Tanggal transaksi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                              include 'library/koneksi.php';
                                              $username = $_SESSION['username'];
                                              $query = "SELECT tbl_penjualan.*, tbl_barang.*, tbl_penjualan_item.* 
                                              FROM tbl_penjualan_item 
                                              INNER JOIN tbl_barang ON tbl_penjualan_item.id_barang=tbl_barang.id_barang 
                                              INNER JOIN tbl_penjualan ON tbl_penjualan_item.no_penjualan=tbl_penjualan.no_penjualan
                                              WHERE tbl_penjualan.username='$username' 
                                              LIMIT $awalData, $jumlalahPerHalaman " ;
                                              $hasil = mysqli_query($conn, $query);
                                              $no = 1;
                                              while ($data = mysqli_fetch_array($hasil)) {

                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['no_penjualan'] ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['tgl_transaksi'] ?></td>
                                                    <td>
                                                        <?php  
                                                        if($data['status']=='1'){
                                                          echo "<button class='btn btn-warning'>Payment</button>";
                                                        }
                                                        else{
                                                          echo "<button class='btn btn-success'>Cash</button>";
                                                        }

                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php $no++; } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; YUPS MART 2023</span>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/tamplate/vendor/jquery/jquery.min.js"></script>
    <script src="assets/tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/tamplate/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/tamplate/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/tamplate/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/tamplate/js/demo/chart-area-demo.js"></script>
    <script src="assets/tamplate/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="assets/tamplate/vendor/datatables/jquery.dataTables.min.js"></script> -->
    <script src="assets/tamplate/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/tamplate/js/demo/datatables-demo.js"></script>

</body>

</html>