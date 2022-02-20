<?php
include_once("../phplib/config.php");
$url = "https://api.stripe.com/v1/customers/cus_LBURwEBb3znGGI";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Authorization: Bearer $strkey",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
$json = json_encode($resp);
$obj = json_decode($resp);
$check_paytype = $obj->{'invoice_settings'}->{'default_payment_method'};
if($check_paytype == null || $check_paytype == "null"){
    echo "<script> console.log('Geen betaalmethode'); </script>";
}else{
    echo "<script> console.log('$check_paytype'); </script>";
}

?>

