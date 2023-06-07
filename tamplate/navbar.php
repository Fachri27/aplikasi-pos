<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(#0b4cbd, #4272c7)">
    <div class="container">
      <img src="img/img1.jpg" class="rounded-circle mr-5" width="50" height="50">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/barang/view_barang.php">Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/kategori/view_kategori.php">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/users/view_users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/transaksi/laporan.php">Laporan</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="logout.php"><button class="btn my-2 my-sm-0 text-white" type="button" style="background-color: red;">Keluar</button></a>
        </form>
      </div>
    </div>
  </nav>
</body>
</html>