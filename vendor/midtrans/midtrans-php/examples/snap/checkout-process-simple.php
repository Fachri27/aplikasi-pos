<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
//Set Your server key
Config::$serverKey = "SB-Mid-server-itZXwDLRlohYlyANQjPhsor8";
// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

//koneksi
$conn = mysqli_connect('localhost', 'root', '', 'db_pos');

$no_penjualan = $_GET['no_penjualan'];
$query = "SELECT tbl_barang.id_barang, tbl_barang.nama_barang, tbl_penjualan.no_penjualan, tbl_penjualan.username, tbl_penjualan_item.*
    FROM tbl_penjualan_item
    JOIN tbl_penjualan ON tbl_penjualan_item.no_penjualan=tbl_penjualan.no_penjualan
    JOIN tbl_barang ON tbl_penjualan_item.id_barang=tbl_barang.id_barang
    WHERE tbl_penjualan_item.no_penjualan=$no_penjualan";

$hasil = mysqli_query($conn, $query);
$total = 0; 
$qtyBrg = 0;

while ($data = mysqli_fetch_array($hasil)) {
    $id = $data['id'];
    $subtotal = $data['jumlah'] * $data['harga_jual'];
    $total = $total + ($data['jumlah'] * $data['harga_jual']);
    $qtyBrg = $qtyBrg + $data['jumlah'];
    $result_list[] = $data;
}

// Required
$transaction_details = array(
    'order_id' => $no_penjualan,
    'gross_amount' => $total, // no decimal allowed for creditcard
);

// Optional
foreach ($result_list as $data)

    $item_details[] = array (

        'id' => $data['id_barang'],
        'price' => $data['harga_jual'],
        'quantity' => $data['jumlah'],
        'name' => $data['nama_barang']
    );

// Optional
// $customer_details = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'email'         => "andri@litani.com",
//     'phone'         => "081122334455",
//     // 'billing_address'  => $billing_address,
//     // 'shipping_address' => $shipping_address
// );

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
);

$snapToken = Snap::getSnapToken($transaction);
echo "snapToken = ".$snapToken;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body>
        <button id="pay-button" class="btn btn-primary">Pay!</button>
        <!-- <a href="../../../../../pages/transaksi/form-trans.php" class="btn btn-danger">Kembali</a> -->
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-puddmi28m3CovsNI"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snapToken?>');
            };
        </script>
    </body>
</html>
