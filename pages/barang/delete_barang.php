<?php  
include '../../library/koneksi.php';
include '../../assets/footer.php';
session_start();

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tbl_barang WHERE id_barang='$id'");

if ($query) {
		$_SESSION["sukses"] = 'Data berhasil di hapus';
		header('location: admin-barang.php');
}
else{
	echo "terdeteksi error". mysqli_error($conn);
}

?>