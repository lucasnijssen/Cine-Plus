<?php
include_once("../../phplib/config.php");
// Create connection
$audit_conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);

if ($audit_conn->connect_error) {
    die("Connection failed: " . $audit_conn->connect_error);
}

$audit_sql = "INSERT INTO `audit_log` (`gebruiker`, `actie`, `info`) VALUES ('$audit_user','$audit_actie','$audit_info')";
if ($audit_conn->query($audit_sql) === TRUE) {

} else {
    
}
?>