<?php  
session_start();
include '../../library/koneksi.php';
include '../../assets/footer.php';

$username = $_SESSION['username'];
$jumlalahPerHalaman = 5;
$jumlahData = mysqli_query($conn, "SELECT tbl_barang.id_barang, tbl_barang.nama_barang,     tbl_barang.harga_beli, tbl_barang.harga_jual, tbl_barang.diskon, tbl_barang.stok,tbl_kategori.nama_kategori 
    FROM tbl_barang 
    JOIN tbl_kategori ON tbl_barang.id_kategori=tbl_kategori.id_kategori
    ORDER BY id_barang ASC");

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

    <title>Admin-Data Barang</title>

    <link rel="shortcut icon" href="../../img/img5.png">
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
                <a class="nav-link" href="../../dash-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                INTERFACE
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Barang</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Barang:</h6>
                        <a class="collapse-item" href="admin-barang.php">Data Barang</a>
                        <a class="collapse-item" href="tambah-barang.php">Tambah Barang</a>
                    </div>
                </div>
            </li>

           <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Kategori</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Kategori:</h6>
                        <a class="collapse-item" href="../kategori/admin-kat.php">Data Kategori</a>
                        <a class="collapse-item" href="../kategori/form-kat.php">Tambah Kategori</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Users:</h6>
                        <a class="collapse-item" href="../users/admin-user.php">Data Users</a>
                        <a class="collapse-item" href="../users/form-user.php">Tambah Users</a>
                    </div>
                </div>
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
                        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row animate__animated animate__slideInLeft animate__slow 0.5s">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
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
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Nama Barang</th>
                                                  <th scope="col">Kategori</th>
                                                  <th scope="col">Harga Beli</th>
                                                  <th scope="col">Harga Jual</th>
                                                  <th scope="col">Diskon</th>
                                                  <th scope="col">Stok</th>
                                                  <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                            include '../../library/koneksi.php';
                                            $query = "SELECT tbl_barang.id_barang, tbl_barang.nama_barang, tbl_barang.harga_beli, tbl_barang.harga_jual, tbl_barang.diskon, tbl_barang.stok,tbl_kategori.nama_kategori 
                                                FROM tbl_barang 
                                                JOIN tbl_kategori ON tbl_barang.id_kategori=tbl_kategori.id_kategori
                                                ORDER BY id_barang ASC
                                                LIMIT $awalData, $jumlalahPerHalaman";
                                            $hasil = mysqli_query($conn, $query);
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($hasil)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                  <th scope="row"><?= $no; ?></th>
                                                  <td><?= $data['nama_barang'] ?></td>
                                                  <td><?= $data['nama_kategori'] ?></td>
                                                  <td><?= $data['harga_beli'] ?></td>
                                                  <td><?= $data['harga_jual'] ?></td>
                                                  <td><?= $data['diskon'] ?>%</td>
                                                  <td><?= $data['stok'] ?></td>
                                                  <td>
                                                    <a href="edit-bar.php?id=<?= $data['id_barang'] ?>"><button class="btn btn-warning" type="button">Edit</button></a>
                                                    <a href="delete_barang.php?id=<?= $data['id_barang'] ?>" class="btn btn-danger notif-alert">Hapus</a>
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

    <?php if(@$_SESSION['sukses']){ ?>
            <script>
                Swal.fire({            
                    icon: 'success',                   
                    title: 'Sukses',    
                    text: 'data berhasil dihapus',                        
                    timer: 3000,                                
                    showConfirmButton: false
                })
            </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>

    <script type="text/javascript">
        $('.notif-alert').on('click',function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: 'Yakin hapus data?',            
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Batal'
            
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