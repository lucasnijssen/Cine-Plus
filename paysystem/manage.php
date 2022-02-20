<?php
include_once("../phplib/config.php");
$url = "https://api.stripe.com/v1/billing_portal/sessions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Authorization: Bearer $strkey",
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "customer=$dta_usr_stripeid&return_url=https://dev.cine-plus.nl/user-settings.html";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$json = json_encode($resp);
$obj = json_decode($resp);
$stripe_klantportaal = $obj->{'url'};

?>

<script>
   function goManager(){
      window.open(url, '<?php echo $stripe_klantportaal; ?>').focus();
   }
   document.getElementById('goSettings').onclick = function() {
    var redirectWindow = window.open('<?php echo $stripe_klantportaal; ?>', '_blank');
    redirectWindow.location;
};
</script>