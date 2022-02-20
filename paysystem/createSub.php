<?php
function createSub(){
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
    
    $data = "customer=$dta_usr_stripeid&return_url=https://dev.cine-plus.nl";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    $json = json_encode($resp);
    $obj = json_decode($resp);
    $sendurl = $obj->{'url'};
    echo $sendurl;
    return $sendurl;
}
?>
<script>
    function relocate_home(){
         location.href = "<?php echo createSub(); ?>";
    }
</script>