<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
//Set Your server key
Config::$serverKey = "<your server key>";

// Uncomment for production environment
// Config::$isProduction = true;

// Uncomment to enable sanitization
Config::$isSanitized = Config::$is3ds = true;

// Uncomment to enable 3D-Secure


// Required
$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => 145000, // no decimal allowed for creditcard
);

// Optional
$item1_details = array(
    'id' => 'a1',
    'price' => 50000,
    'quantity' => 2,
    'name' => "Apple"
);




// // Fill SNAP API parameter
// $params = array(
//     'transaction_details' => $transaction_details,
//     'customer_details' => $customer_details,
//     'item_details' => $item_details,
// );

// try {
//     // Get Snap Payment Page URL
//     $paymentUrl = Snap::createTransaction($params)->redirect_url;
  
//     // Redirect to Snap Payment Page
//     header('Location: ' . $paymentUrl);
// }
// catch (Exception $e) {
//     echo $e->getMessage();
// }
