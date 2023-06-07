<?php  
include '../../library/koneksi.php';
include '../../assets/footer.php';

$nama_barang = $_POST['nam_bar'];
$kategori	 = $_POST['kategori'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$diskon		 = $_POST['diskon'];
$stok		 = $_POST['stok'];

//cekdata
$cekdata = mysqli_query($conn, "SELECT nama_barang FROM tbl_barang WHERE nama_barang='$nama_barang' ");

if($nama_barang == ""){
	echo "<script>
			Swal.fire(
			 'Silahkan diisi dulu', '', 'warning'
			).then((result) => {
	          if (result.isConfirmed) {
	            history.go(-1);
	          }
	        });

		  </script>";
}
elseif (mysqli_num_rows($cekdata) > 0) {
	echo "<script>
			Swal.fire(
			 'Data sudah ada', '', 'warning'
			).then((result) => {
	          if (result.isConfirmed) {
	            history.go(-1);
	          }
	        });

		  </script>";
}
else{

	$query = mysqli_query($conn, "INSERT INTO tbl_barang (nama_barang, harga_beli, harga_jual, diskon, stok, id_kategori) VALUES ('$nama_barang', '$harga_beli', '$harga_jual', '$diskon', '$stok', '$kategori')");
	if ($query) {
		echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('admin-barang.php');
			          }
			        });
				  </script>";
	}
	else{
		echo "<script>
			Swal.fire(
			 'Data gagal di tambah', '', 'warning'
			).then((result) => {
	          if (result.isConfirmed) {
	            history.go(-1);
	          }
	        });

		  </script>";
	}
}
?>