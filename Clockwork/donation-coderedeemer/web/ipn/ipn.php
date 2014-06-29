<?php  
require "paypal.class.php";
require "../config.php";

function get_new_key(){
    $keycharacters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for($i = 0; $i < 10; $i++){
      $key .= $keycharacters[rand(0,strlen($keycharacters)-1)];
    }
    return $key;
  }


$p = new paypal_class;
$p->paypal_url = $payPalURL; // $payPalURL is defined in config.php

$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
//if (empty($_GET['action'])) $_GET['action'] = 'process';  

$file = 'ipn.log';
    
if ($p->validate_ipn()) {
  $status = "[".date("m.d.y H:i:s")."] Start of notification \n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);

    $item_name = $p->ipn_data['item_name'];
    $item_number = $p->ipn_data['item_number']; 
    $payment_status = $p->ipn_data['payment_status'];
    $payment_amount   = $p->ipn_data['mc_gross'];
    $payment_currency = $p->ipn_data['mc_currency'];
    $txn_id           = $p->ipn_data['txn_id'];
    $receiver_email   = $p->ipn_data['receiver_email'];
    $payer_email      = $p->ipn_data['payer_email'];
    

    $txt_log = "[".date("m.d.y H:i:s")."] TransactionID: $txn_id  \n";
    file_put_contents($file, $txt_log, FILE_APPEND | LOCK_EX);

// Refund Protection
if($payment_status == "Refunded" || $payment_status == "Reversed")  
{
$sql = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if (mysqli_connect_errno())
  {
  $error = "Failed to connect to MySQL: " . mysqli_connect_error();
  file_put_contents($file, $error, FILE_APPEND | LOCK_EX);
  }
$trans =  "update activationkeys set used = 1 where transid = ".$txn_id.";";
if ( $sql->query($trans) ) {
  $status = "[".date("m.d.y H:i:s")."] Refund protection for donation transid ".$txn_id.". Refund Status: ".$payment_status."\n [".date("m.d.y H:i:s")."] End of notification \n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
  $msg = "$payer_email has refunded their donation, 
  I've stopped the key from being used, but if its already been redeemed you'll have to take the benefits from them
  Transaction ID: $txn_id
  Payment Status: $payment_status
  Payment Amount: $payment_amount
  Item name: $item_name
  ";
  $headers = "From: $config_sender_email" . "\r\n";
  mail($receiver_email,"Important! Donation Refund",$msg,$headers);
} else {
  $status = "[".date("m.d.y H:i:s")."] -ERROR- There was a problem:<br />$query<br />{$sql->error}\n [".date("m.d.y H:i:s")."] End of notification \n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
}
die();
}



// Checks
    $array = $payments;
    if ( ! in_array( $payment_amount, $array ) )
    {
        $status = "[".date("m.d.y H:i:s")."] -ERROR- Payment not allowed amount: ".$payment_amount." \n[".date("m.d.y H:i:s")."] End of notification \n";
        file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
        die();
    } 

    
    // 1. Make sure the payment status is "Completed" 
    if ($payment_status != 'Completed') { 
        $status = "[".date("m.d.y H:i:s")."] -ERROR- Payment not complete: ".$payment_status." \n[".date("m.d.y H:i:s")."] End of notification \n";
        file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    if ($receiver_email != $config_merchant_email) {
          $status = "[".date("m.d.y H:i:s")."] -ERROR- Merchant Email Not match. ".$receiver_email." \n[".date("m.d.y H:i:s")."] End of notification \n";
          file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
          exit(0);
    }


/* make your connection */
$sql = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno())
  {
  $error = "Failed to connect to MySQL: " . mysqli_connect_error();
  file_put_contents($file, $error, FILE_APPEND | LOCK_EX);
  }

$trans =  "INSERT INTO notifications VALUES( DEFAULT, '$item_name','$item_number','$payment_status','$payment_amount','$payment_currency','$txn_id','$receiver_email','$payer_email')";
if ( $sql->query($trans) ) {
  $status = "[".date("m.d.y H:i:s")."] A new transaction has been added with the `id` of {$sql->insert_id}.\n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
} else {
  $status = "[".date("m.d.y H:i:s")."] -ERROR- There was a problem:<br />$query<br />{$sql->error}\n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
}
 
$key = get_new_key();
$addcode = 'INSERT INTO activationkeys VALUES(DEFAULT, "'.$txn_id.'", "'.$key.'", "0", "'.$item_number.'", "'.$item_name.'")';

if ( $sql->query($addcode) ) {
  $status = "[".date("m.d.y H:i:s")."] A new key has been added with the `id` of {$sql->insert_id}.\n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
} else {
  $status = "[".date("m.d.y H:i:s")."] -ERROR- There was a problem:<br />$query<br />{$sql->error}\n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);
}

$status = "[".date("m.d.y H:i:s")."] End of notification \n";
  file_put_contents($file, $status, FILE_APPEND | LOCK_EX);

/* close our connection */
$sql->close();

    // Email messages
    $keyemail = '
    <html>
    <body>
    <h1>Thanks for donating!</h1>
    You paid:'.$payment_amount.'<br>
    Your package:'.$item_name.'<br>
    <hr>
    Here is your key:<br>
    <big>'.$key.'</big><br>
    <b>This is a one-time key! Enter it in game using /redeem.</b>
    </body>
    </html>

    ';

      // Email Buyer
      $to      = $payer_email;
      $subject = 'Donation Complete!';  
      $message = $keyemail;
      $headers = 'From: '.$config_sender_name.' <'.$config_sender_email.'>' . "\r\n";  
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
      mail($to, $subject, $message, $headers);



    }
?>  