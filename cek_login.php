<?php  
include 'library/koneksi.php';
include 'assets/footer.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM tbl_users WHERE username='$username'";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$cek = mysqli_num_rows($hasil);

if($cek > 0){

	if(password_verify($password, $data['password'])){

		session_start();
		//memangil session
		$_SESSION['login'] = true;
		$_SESSION['id'] = $data['id'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['foto'] = $data['foto'];

		if($_SESSION['level']=='kasir'){
			// header('location: dash-kasir.php');
			echo "<script>
			        Swal.fire({
			          title: 'Berhasil Masuk',
			          text: 'Sebagai $_SESSION[username]',
			          icon: 'success',
			          confirmButtonColor: '#3085d6',
			          confirmButtonText: 'OK'
			        }).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('dash-kasir.php');
			          }
			        });
			    </script>";
		}
		else{
			echo "<script>
			        Swal.fire({
			          title: 'Berhasil Masuk',
			          text: 'Sebagai $_SESSION[username]',
			          icon: 'success',
			          confirmButtonColor: '#3085d6',
			          confirmButtonText: 'OK'
			        }).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('dash-admin.php');
			          }
			        });
			    </script>";
		}

	}
	else{

		echo "<script>
				Swal.fire({
				  title: 'PASSWORD KAMU SALAH',
				  icon: 'warning',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK!'
				}).then((result) => {
				  if (result.isConfirmed) {
				    history.go(-1)
				  }
				});
			  </script>";
	}
}
else{
	echo "<script>
				Swal.fire({
				  title: 'Username atau Password belum terdaftar',
				  icon: 'warning',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK!'
				}).then((result) => {
				  if (result.isConfirmed) {
				    history.go(-1)
				  }
				});
			  </script>";
}
?>