<!-- Project: Cine-Plus. Code Author: Boyke van Vugt. -->
<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.html");
    exit;
}
?>


<?php 
include_once("config.php");
$gebruikersid = $_SESSION["id"];
$phsid = $_COOKIE["PHPSESSID"];
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
        $user_sessionid = $row["sesid"];
        $user_subtype = $row["sub"];
    }
} else {

}
$conn->close();

if($user_subtype == 1){
    $data_subtype = "Basic";
}else if($user_subtype == 2){
    $data_subtype = "Unlimited";
}else if($user_subtype == 3){
    $data_subtype = "Medewerker Abonnement";
}else{
    $data_subtype = "Geen abonnement";
}

if($user_sessionid == $phsid){
    
}else{
    header("location: logout.html");
}
?>