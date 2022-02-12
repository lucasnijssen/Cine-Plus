<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["zoek"]) || !empty($_POST["zoek"])){
    $zoek = $_POST["zoek"];
    $sql = "SELECT * FROM `users` WHERE `username` LIKE '%" . $zoek . "%'";
}else{
    $sql = "SELECT * FROM `users`";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["username"] . '</td>';
        $ustat = $row["verify"];
        $urang = $row["ranglevel"];
        if($ustat = 1 && $urang >= 4){
            $status = "Actief";
        }else if($ustat == 1 && $urang < 4){
            $status = "Verbannen";
        }else{
            $status = "Wachten op activatie";
        }
        $date = date('m-d-Y H:i', strtotime($row["created_at"]));
        echo '<td>' . $status . '</td>';
        echo '<td>' . $urang . '</td>';
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