<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `admin_global_alerts` ORDER BY `datum` DESC LIMIT 10";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["mes_title"] . '</td>';
        echo '<td>' . $row["mes_text"] . '</td>';
        echo "<td><a href='javascript:void(0);'  onclick='showNumer" . $row['id'] . "();' class='btn btn-success' role='button' style='margin: inherit;'>Bekijk</a>";
        echo "<a href='javascript:void(0);'  onclick='resendNumer" . $row['id'] . "();' class='btn btn-danger' role='button' style='margin: inherit;'>Resend</a></td>";
        echo "<script>function showNumer" . $row['id'] . "() { Swal.fire({title: '" . $row["mes_title"] . "',text:'" . $row["mes_text"] . "', showConfirmButton: true }) }</script>";
        echo "<script>resendNumer" . $row['id'] . "() { ws.send(JSON.stringify({ id: 'send-admin-alert', titel: '" . $row["mes_title"] . "', text: '" . $row["mes_text"] . "' })); ws.send(JSON.stringify({ id: 'audit-log', user: " . $gebid . ", actie: 'Admin Systeem Notifactie verstuurd', info: 'Verstuurde notificatie met titel " . $row["mes_title"] . "' })); }</script>";
        echo '</tr>';
    }
} else {
    echo "<tr>";
    echo '<td>Geen Berichten</td>';
    echo '</tr>';
}
$conn->close();
?>