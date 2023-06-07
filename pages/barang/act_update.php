<?php  
include '../../library/koneksi.php';
include '../../assets/footer.php';

$id = $_POST['id'];
$nama_barang = $_POST['nam_bar'];
$kategori	 = $_POST['kategori'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$diskon		 = $_POST['diskon'];
$stok		 = $_POST['stok'];

//cekdata
$cekdata = mysqli_query($conn, "SELECT nama_barang FROM tbl_barang WHERE nama_barang='$nama_barang'");

if($nama_barang == ""){
	echo "<script>
			Swal.fire(
			 'Silahan diisi dulu', '', 'warning'
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

	$query = mysqli_query($conn, "UPDATE tbl_barang SET nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', diskon='$diskon', stok='$stok', id_kategori='$kategori' WHERE id_barang = '$id' ");

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