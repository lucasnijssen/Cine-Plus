<?php
session_start();
require_once "config.php";
$gebruikersid = $_SESSION["id"];
$code = $_POST['verifycode'];
echo "<script>console.log('$code')</script>";

if(isset($_POST['verifycode'])){
    $sql = "UPDATE `users` SET `verify`='1', `code`=null WHERE id= $gebruikersid AND code= '$code'";
    echo "Error: " . $sql . "<br>" . $conn->error;
    if ($conn->query($sql) === TRUE) {
        echo "Done";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

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
        $verstat = $row["verify"];
    }
} else {

}
$conn->close();

if($verstat == 1){
    header("location: index.html");
}else{
    
}
?>