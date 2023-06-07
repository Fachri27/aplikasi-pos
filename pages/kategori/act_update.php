<?php  
include '../../assets/footer.php';
include '../../library/koneksi.php';

$nam_kat = $_POST['nam_kat'];
$nam_katlama = $_POST['nam_katlama'];

//cek data
$cekdata = mysqli_query($conn, "SELECT nama_kategori FROM tbl_kategori WHERE nama_kategori='$nam_kat' AND NOT nama_kategori='$nam_katlama'");

if (mysqli_num_rows($cekdata) > 0) {
	echo "<script>
			Swal.fire(
			 'Data sudah ada', '', 'warning'
			).then((result) => {
	          if (result.isConfirmed) {
	            history.go(-1);
	          }
	        });

		  </script>";
}else{

	$query = mysqli_query($conn, "UPDATE tbl_kategori SET nama_kategori='$nam_kat' WHERE id_kategori='$_POST[id]'");

	if ($query) {
		echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('admin-kat.php');
			          }
			        });
				  </script>";
	}else{
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