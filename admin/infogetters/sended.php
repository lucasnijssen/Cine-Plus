<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["zoek"]) || !empty($_POST["zoek"])){
    $zoek = $_POST["zoek"];
    $sql = "SELECT * FROM `admin_messages` WHERE `title` LIKE '%" . $zoek . "%'";
}else{
    $sql = "SELECT * FROM `movies`";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["message_short"] . '</td>';
        echo "<td><a href='javascript:void(0);'  onclick='showNumer " . $row['id'] . "();' class='btn btn-success' role='button' style='margin: inherit;'>Bekijk</a>";
        echo "<a href='?delmov=" . $row["id"]. "' class='btn btn-danger' role='button' style='margin: inherit;'>Delete</a></td>";
        echo "<script>function showNumer" . $row['id'] . "{ Swal.fire({ icon: 'success', title: 'Film verwijderd', showConfirmButton: false, timer: 3000, }) }</script>";
        echo '</tr>';
    }
} else {
    echo "<tr>";
    echo '<td>Geen Berichten</td>';
    echo '</tr>';
}
$conn->close();
?>

<?php
if (isset($_GET["delmov"])) {
$deleteprod_id = $_GET["delmov"];
// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `admin_messages` WHERE `id` = $deleteprod_id";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
	echo "<script>Swal.fire({ icon: 'success', title: 'Bericht verwijderd', showConfirmButton: false, timer: 3000, }).then((result) => { let url = window.location.href; let red = url.replace('?delmov=". $deleteprod_id . "', ''); window.location.href = red; })</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else{

}
?>