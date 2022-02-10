<?php
session_start();
$gebruikersid = $_SESSION["id"];
include_once("../phplib/config.php");
?>

<?php 
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
        $usr_rank = $row["ranglevel"];
    }
} else {
    $usr_rank = 0;
}
$conn->close();

if($usr_rank >= 10){
    echo "Je bent een admin :)";
}else{
    echo "Je bent geen admin, wat doe je hier? :(";
}
?>