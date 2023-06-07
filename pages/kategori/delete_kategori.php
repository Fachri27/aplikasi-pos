<?php  
include '../../library/koneksi.php';
session_start();
$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tbl_kategori WHERE id_kategori='$id'");

if ($query) {
		$_SESSION["sukses"] = 'Data berhasil di hapus';
		header('location: admin-kat.php');
}else{
		echo "terdeteksi error". mysqli_error($conn);
}

?>