<?php  
include '../../library/koneksi.php';
include '../../assets/footer.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST)){

	if(isset($_POST['btnPilih'])){
		$id_brg = $_POST['id_brg'];
		$qty = $_POST['qty'];
		$username = $_SESSION['username'];

		$ambil = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE nama_barang='$id_brg' OR id_barang='$id_brg'");
		$tangkap = mysqli_fetch_array($ambil);
		$cek = mysqli_num_rows($ambil);
		// var_dump($cek);
		// exit;

		if($cek >= 1){	

			$harga = ($tangkap['diskon']/100)*$tangkap['harga_jual'];
			$harga_akhir = $tangkap['harga_jual']-$harga ;

			$query = mysqli_query($conn, "INSERT INTO tbl_keranjang(id_barang, harga_jual, qty, username) VALUES ('$id_brg', '$harga_akhir', '$qty', '$username')");
		 	
			echo "<script>
					Swal.fire({
					  position: 'top',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('form-trans.php');
			          }
			        });
				  </script>";
		}
		else{
			echo "<script>
					Swal.fire(
					 'Silahkan ganti nama barang', '', 'warning'
					).then((result) => {
			          if (result.isConfirmed) {
			            history.go(-1);
			          }
			        });

				  </script>";
		}
	}

	if (isset($_POST['btnPayment'])) {
		$no_penjualan = rand(10000, 99999);
		$username = $_SESSION['username'];

		$cekKrg = mysqli_query($conn, "SELECT COUNT(*) AS qty FROM tbl_keranjang WHERE username = '$username'");
		$krgRow = mysqli_fetch_array($cekKrg);

		if($krgRow['qty'] <= 0){

			echo "<script>
					alert('Belum ada item barang minimal 1 !')
					location.replace('form-trans.php')
				  </script>";
		} 
		else{

			$queryPenjualan = mysqli_query($conn, "INSERT INTO tbl_penjualan SET no_penjualan='$no_penjualan', tgl_transaksi=now(), status='1', username='$username' ");


			if($queryPenjualan){
				# ambil data dari keranjang
				$cekKrg = mysqli_query($conn, "SELECT * FROM tbl_keranjang WHERE username = '$username' ");

				while ($krgRow = mysqli_fetch_array($cekKrg)) {
					# insert data ke tabel penjualan item
					$queryItem = mysqli_query($conn, "INSERT INTO tbl_penjualan_item SET no_penjualan='$no_penjualan', id_barang='$krgRow[id_barang]', harga_jual='$krgRow[harga_jual]', jumlah='$krgRow[qty]' ");

					#update stok tabel
					$queryBarang = mysqli_query($conn, "UPDATE tbl_barang SET stok= stok - $krgRow[qty] WHERE id_barang='$krgRow[id_barang]'");
				}


				//kosongkan keranjang jika sudah di move
				mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE username='$username'");
			}
		}
		echo "<meta http-equiv='refresh' content='0;url=../../vendor/midtrans/midtrans-php/examples/snap/checkout-process-simple.php?no_penjualan=$no_penjualan'>";
		// header("location: ../../vendor/midtrans/midtrans-php/examples/snap/checkout-process-simple.php?no_penjualan='$no_penjualan'");
	}
// var_dump($_POST); 
// exit;
	if (isset($_POST['btnCash'])) {
		// $id_brg = $_POST['id_brg'];
		$no_penjualan = rand(10000, 99999);
		$username = $_SESSION['username'];

		//mengkonversi ke database
		// $tanggalTransaksi = tgl_transaksi($tgl_transaksi);

		$cekKrg = mysqli_query($conn, "SELECT count(*) AS qty FROM tbl_keranjang WHERE username = '$username'");
		$krgRow = mysqli_fetch_array($cekKrg);

		if($krgRow['qty'] <= 0){
			echo "<script>
					Swal.fire(
					 'Belum memilih barang, minimal 1!', '', 'warning'
					).then((result) => {
			          if (result.isConfirmed) {
			            history.go(-1);
			          }
			        });

				  </script>";
		}
		elseif($_POST['bayar'] < $_POST['total']){
			echo "<script>
					Swal.fire(
					 'Uang anda tidak cukup', '', 'warning'
					).then((result) => {
			          if (result.isConfirmed) {
			            history.go(-1);
			          }
			        });

				  </script>";
		} 
		else{

			$queryPenjualan = mysqli_query($conn, "INSERT INTO tbl_penjualan SET no_penjualan='$no_penjualan', tgl_transaksi=now(), status='2', username='$username' ");


			if($queryPenjualan){
				# ambil data dari keranjang
				$cekKrg = mysqli_query($conn, "SELECT * FROM tbl_keranjang WHERE username = '$username' ");
				while ($krgRow = mysqli_fetch_array($cekKrg)) {
					# insert data ke tabel penjualan item
					$queryItem = mysqli_query($conn, "INSERT INTO tbl_penjualan_item SET no_penjualan='$no_penjualan', id_barang='$krgRow[id_barang]', harga_jual='$krgRow[harga_jual]', jumlah='$krgRow[qty]' ");

					#update stok tabel
					$queryBarang = mysqli_query($conn, "UPDATE tbl_barang SET stok= stok - $krgRow[qty] WHERE id_barang='$krgRow[id_barang]'");
				}


				//kosongkan keranjang jika sudah di move
				mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE username='$username'");
			}
			echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Transaksi berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('form-trans.php');
			          }
			        });
				  </script>";
		}
		// echo "<meta http-equive='refresh' content='0;url=form_transaksi.php'>";
		
	}
}


?>