<?php 
include_once "config.php";
$gebruikersid = $_SESSION["id"];

$conn = new mysqli($servername, $username, $password, $dbname);
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
    }
} else {

}
$conn->close();

if($verstat == 0){

}else{
    header("location: verify.html");
}


?>