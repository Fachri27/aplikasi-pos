<?php  
include '../../library/koneksi.php';
include '../../assets/footer.php';

$username = $_POST['username'];
$nama_lengkap = $_POST['nama_lengkap'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

//gambar
$ekstension = array('jpg', 'jpeg', 'png');
$filename	= $_FILES['foto']['name'];
$tmp		= $_FILES['foto']['tmp_name'];
$eks 		= pathinfo($filename, PATHINFO_EXTENSION);

$folder 	= "gambar/$filename";

//cek username
$cekdata = mysqli_query($conn, "SELECT username FROM tbl_users WHERE username='$username'");

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
}
else{

	if ($filename == "") {

		$query = mysqli_query($conn, "INSERT INTO tbl_users (username, password, nama_lengkap) VALUES('$username', '$pass', '$nama_lengkap') ");

		echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('admin-user.php');
			          }
			        });
				  </script>";

	}
	elseif(! in_array($eks, $ekstension)){

			echo "<script>
			Swal.fire(
			 'Ekstensi tidak sesuai', '', 'warning'
			).then((result) => {
	          if (result.isConfirmed) {
	            history.go(-1);
	          }
	        });

		  </script>";
	}
	else{
		move_uploaded_file($tmp, $folder);
		$query2 = mysqli_query($conn, "INSERT INTO tbl_users (username, password, nama_lengkap, foto) VALUES('$username', '$pass', '$nama_lengkap', '$filename') ");

		echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('admin-user.php');
			          }
			        });
				  </script>";
	}

	

	
}

?>