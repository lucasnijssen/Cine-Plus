<?php 
include_once "config.php";
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
        $verstat = $row["verify"];
        $level = $row["ranglevel"];
        $dta_usr_mail = $row["username"];
    }
} else {

}
$conn->close();

if($level < 4){
    header("location: banned.html");
}

if($verstat == 0){
    header("location: verify.html");
}else{
    
}
?>