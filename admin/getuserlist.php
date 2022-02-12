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
        if($ustat == 1 && $urang >= 4){
            $status = "<td style='color:green;'>Actief</td>";
        }else if($ustat == 1 && $urang < 4){
            $status = "<td style='color:red;'>Verbannen</td>";
        }else{
            $status = "<td style='color:orange;'>Wachten op activatie</td>";
        }

        if($urang == 4){
            $urang_name = "Gebruiker";
        }else if($urang == 10){
            $urang_name = "Admin";
        }else if($urang < 4){
            $urang_name = "Banned";
        }else{
            $urang_name == "ERROR";
        }

        $date = date('m-d-Y H:i', strtotime($row["created_at"]));
        echo $status;
        echo '<td>' . $urang_name . '</td>';
        echo '<td>' . $date . '</td>';
        echo "<td><a href='./showuser.php?id=" . $row["id"]. "' class='btn btn-success' role='button' style='margin: inherit;'>Info</a></td>";
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