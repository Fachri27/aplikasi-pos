<?php  
session_start();
include '../../library/koneksi.php';
include '../../assets/footer.php';

if (!isset($_SESSION['login'])) {
    header("location: index.php");
}

if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op = "";
}

if($op == 'hapus'){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE id='$id'");
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

    <title>Transaksi</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/tamplate/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/tamplate/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../assets/tamplate/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <a class="nav-link" href="../../dash-kasir.php">
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
                <a class="nav-link" href="../../kasir-barang.php">
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

                    <img src="../../img/img4.png" width="45" height="40">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama_lengkap']?></span>
                                <img class="img-profile rounded-circle"
                                    src="../users/gambar/<?= $_SESSION['foto'] ?>">
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
                        <h1 class="h3 mb-0 text-gray-800">Form Transaksi</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row animate__animated animate__slideInLeft animate__slow 0.5s">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form action="act_transaksi.php" method="post" name="formD">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="id_brg" class="form-control">
                                                <option value="0">-pilih barang-</option>
                                                <?php  
                                                $query = mysqli_query($conn, "SELECT * FROM tbl_barang");   
                                                while($data = mysqli_fetch_array($query)){
                                                ?>
                                                <option value="<?= $data['id_barang'] ?>"><?= $data['nama_barang'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="numeric" name="qty" class="form-control" id="exampleInputPassword1">
                                        </div>
                                        <button type="submit" name="btnPilih" class="btn btn-primary btn-block" id="pilih">Pilih</button>
                                        <br><br>
                                        <!-- tabel keranjang -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Id Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga</th>
                                                        <th>Diskon</th>
                                                        <th>Harga diskon</th>
                                                        <th>Jumlah</th>
                                                        <th>subtotal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <?php 
                                                $keranjang = mysqli_query($conn, "SELECT tbl_barang.*, tbl_keranjang.id, tbl_keranjang.harga_jual AS harga_jDiskon, tbl_keranjang.qty
                                                    FROM tbl_barang, tbl_keranjang 
                                                    WHERE tbl_barang.id_barang = tbl_keranjang.id_barang 
                                                    ORDER BY tbl_barang.id_barang DESC");

                                                $no = 1;
                                                $total = 0;
                                                $qtybrg = 0;
                                                while ($data1 = mysqli_fetch_array($keranjang)) {
                                                    $id = $data1['id'];
                                                    $subtotal = $data1['qty'] * $data1['harga_jDiskon'];
                                                    $total = $total + ($data1['qty'] * $data1['harga_jDiskon']);
                                                    $qtybrg = $qtybrg + $data1['qty'];
                                                ?>
                                                <tbody>
                                                   <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $data1['id_barang']; ?></td>
                                                        <td><?= $data1['nama_barang']; ?></td>
                                                        <td>Rp. <?= number_format($data1['harga_jual']); ?></td>
                                                        <td><?= $data1['diskon']; ?>%</td>
                                                        <td>Rp. <?= number_format($data1['harga_jDiskon']); ?></td>
                                                        <td><?= $data1['qty']; ?></td>
                                                        <td>Rp. <?= number_format($subtotal); ?></td>
                                                        <td>
                                                            <a href="form-trans.php?op=hapus&id=<?= $data1['id'] ?>" class="btn btn-danger alert-notif">delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; }?>
                                                    <tr>
                                                        <td colspan="6" align="right">
                                                            Grand Total
                                                        </td>
                                                        <td><?= $qtybrg; ?></td>
                                                        <td colspan="2">
                                                            <input type="numeric" name="total" value="<?= $total ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" align="right">Bayar</td>
                                                        <td colspan="2"><input type="numeric" name="bayar" class="form-control" placeholder="Rp." onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" align="right">Kembalian</td>
                                                        <td colspan="2">
                                                            <input type="numeric" placeholder="Rp." name="txtDisplay" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" align="right">Metode Pembayaran</td>
                                                        <td colspan="2">
                                                            <button type="submit" name="btnCash" class="btn btn-success">Cash</button>
                                                            <button type="submit" name="btnPayment" class="btn btn-warning">Payment</button>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </form>
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
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/tamplate/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/tamplate/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/tamplate/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/tamplate/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/tamplate/js/demo/chart-area-demo.js"></script>
    <script src="../../assets/tamplate/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="assets/tamplate/vendor/datatables/jquery.dataTables.min.js"></script> -->
    <script src="../../assets/tamplate/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/tamplate/js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
        totalx = document.formD.total.value;
        document.formD.txtDisplay.value=totalx;
        bayarx = document.formD.bayar.value;
        document.formD.txtDisplay.value=bayarx;

        function OnChange(value){
            totalx = document.formD.total.value;
            bayarx = document.formD.bayar.value;
            kembali = bayarx - totalx;
            document.formD.txtDisplay.value = kembali;
        }

        $('.alert-notif').on('click',function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",            
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink
                }
            })
            return false;
        });

    </script>

</body>

</html>