<?php
include_once("../../phplib/config.php");
// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `audit_log`(`gebruiker`, `actie`, `info`) VALUES ('$audit_user','$audit_actie','$audit_info')";
if ($conn->query($sql) === TRUE) {

} else {
    
}
?>