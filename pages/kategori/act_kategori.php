<?php  
include '../../assets/footer.php';
include '../../library/koneksi.php';

$nam_kat = $_POST['nam_kat'];

//cek data
$cekdata = mysqli_query($conn, "SELECT nama_kategori FROM tbl_kategori WHERE nama_kategori='$nam_kat'");

if($nam_kat == ""){
	echo "<script type='text/javascript'>
			Swal.fire({
			 title: 'Silahkan diisi dulu',
			 icon: 'warning'
			}).then((result) => {
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
}else{

	$query = mysqli_query($conn, "INSERT INTO tbl_kategori(nama_kategori) VALUES ('$nam_kat')");

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