<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `admin_messages` WHERE user= $gebruikersid";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["message_short"] . '</td>';

        $senderid = $row["user"];
        $conn2 = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
        if($senderid == "s"){
            $sendername = "Systeem";
            $conn->close();
        }else{
            $sql3 = "select * from users WHERE id=$senderid";
            $result3 = $conn2->query($sql3);
            if ($result3->num_rows > 0) {
                while($row2 = $result3->fetch_assoc()) {
                    $sendername = $row2["username"];
                    }
                } else {
                    $sendername = "Onbekend";
                }
                $conn2->close();
        }
        $messtat = $row["readed"];

        if($messtat == 0){
            $readstat = '<i style="margin-right:0rem;" class="fas fa-envelope"></i>';
        }else{
            $readstat = '<i style="margin-right:0rem;" class="fas fa-envelope-open-o"></i>';
        }
        echo '<td>' . $sendername . '</td>';
        echo '<td>' . $readstat . '</td>';
        echo "<td><a href='javascript:void(0);'  onclick='showNumer" . $row['id'] . "();' class='btn btn-success' role='button' style='margin: inherit;'>Bekijk</a>";
        echo "<script>function showNumer" . $row['id'] . "() { Swal.fire({title: '" . $row["message_short"] . "',text:'" . $row["message"] . "', showConfirmButton: true }) }</script>";
        echo '</tr>';
    }
} else {
    echo "<tr>";
    echo '<td>Geen Berichten</td>';
    echo '</tr>';
}
$conn->close();
?>