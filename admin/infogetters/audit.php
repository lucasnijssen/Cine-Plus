<!-- Project: Cine-Plus. Code Author: Boyke van Vugt. -->
<?php 
session_start();
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$gebid = $_SESSION["id"];
$sql = "SELECT * FROM `audit_log` WHERE gebruiker= $gebid";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["actie"] . '</td>';
        echo '<td>' . $row["info"] . '</td>';
        $date = date('m-d-Y H:i', strtotime($row["datum"]));
        echo '<td>' . $date . '</td>';
        echo '</tr>';
    }
} else {
    echo "<tr>";
    echo '<td>Geen info</td>';
    echo '<td>-</td>';
    echo '<td>-</td>';
    echo '<td>-</td>';
    echo '<td>-</td>';
    echo '<td>-</td>';
    echo '</tr>';
}
$conn->close();
?>