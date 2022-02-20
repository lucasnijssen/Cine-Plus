<?php
session_start();
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
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $url = "https://api.stripe.com/v1/subscriptions";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Authorization: Bearer $strkey",
       "Content-Type: application/x-www-form-urlencoded",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "customer=$dta_usr_stripeid&items[0][price]=price_1KV5sIC4DanyFX8In3lN2wb8&trial_period_days=14";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    $json = json_encode($resp);
    $obj = json_decode($resp);
    $checkStripeStat = $obj->{'status'};
        if($checkStripeStat == "trailing" || $checkStripeStat == "active"){
            $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
            if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
            $sql = "UPDATE `users` SET `sub`=1 WHERE `username` = '$dta_usr_mail'";
            if ($conn->query($sql) === TRUE) { } else { echo "Error: " . $sql . "<br>" . $conn->error; }
            $conn->close();
            header("location: index.html");
        }
}

?>