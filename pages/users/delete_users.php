<?php  
include '../../library/koneksi.php';
session_start();

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tbl_users WHERE id='$id'");

if($query){
	$_SESSION['sukses'] = 'Data Berhasil di Hapus';
	header('location: admin-user.php');
}
else{

	echo "terdeteksi error".mysqli_error($conn);
}


?>