<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td><img class="rounded-circle me-2" width="30" height="30" src="' . $row["image"] . '">' . $row["movie_id"] . '</td>';
        echo '<td>' . $row["title"] . '</td>';
        echo '<td>' . $row["image"] . '</td>';
        echo '<td>' . $row["info"] . '</td>';
        echo '<td>' . $row["cdn"] . '</td>';
        echo '<td>Actie komt hier</td>';
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