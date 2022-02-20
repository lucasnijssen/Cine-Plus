<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["zoek"]) || !empty($_POST["zoek"])){
    $zoek = $_POST["zoek"];
    $sql = "SELECT * FROM `audit_log` WHERE `actie` LIKE '%" . $zoek . "%'";
}else{
    $sql = "SELECT * FROM `audit_log` WHERE gebruiker= $_SESSION['id']";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        $conn2 = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
        $ulogid = $row["id"];
        $sql3 = "select * from users WHERE id=$ulogid";
            $result3 = $conn2->query($sql3);
            if ($result3->num_rows > 0) {
                while($row2 = $result3->fetch_assoc()) {
                    $sendername = $row2["username"];
                    }
                } else {
                    $sendername = "Onbekend";
                }
        $conn2->close();
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $sendername . '</td>';
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