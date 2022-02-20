<?php
include_once("../phplib/config.php");
$gebruikersid = $_SESSION["id"];

$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from users WHERE id = '$gebruikersid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $dta_usr_mail = $row["username"];
        $dta_usr_stripeid = $row["stripe_id"];
    }
} else {

}
$conn->close();
echo $dta_usr_stripeid;

if($_SERVER['REQUEST_METHOD'] == "POST"){
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
    print_r($obj);
    header("location: $sendurl");
}

?>