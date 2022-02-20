<?php 
include_once "../phplib/config.php";
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
        $usr_sub = $row["sub"];
    }
} else {

}
$conn->close();

if($usr_sub < 1){
    header("location: nosub.html");
}

if($usr_sub == 1){
    $usr_sub_type = "Basic";
}else if($usr_sub == 2){
    $usr_sub_type = "Premium";
}else{
    $usr_sub_type = "Geen";
}

?>