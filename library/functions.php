<?php  

function tgl_transaksi($tgl){
	$pisah = explode('/', $tgl);
	$lari  = array($pisah[2], $pisah[1], $pisah[0]);
	$satukan = implode("-", $lari);

	return $satukan;
}

?>