<?php
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$ses_id = $_COOKIE["PHPSESSID"];
$sql = "select * from users WHERE id = '$gebruikersid' AND sesid = '$ses_id'";
if ($conn->query($sql) === TRUE) {
    $datacheck = true;
} else {
    $datacheck = false;
}
$conn->close();
    
}


if($datacheck == true){

}else{
    header("location: logout.html");
}

?>



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
    }
} else {

}
$conn->close();

if($verstat == 0){
    header("location: verify.html");
}else{
    
}
?>