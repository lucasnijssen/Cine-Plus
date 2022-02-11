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
        echo '<td><a href="https://cine-plus.nl/player.html?iv=' . $row["movie_id"] .'" target="_blank"> ' . $row["movie_id"] . '</a></td>';
        echo '<td>' . $row["title"] . '</td>';
        echo '<td>' . $row["info"] . '</td>';
        echo '<td>' . $row["cdn"] . '</td>';
        echo "<td><a href='./show.php?id=" . $row["id"]. "' class='btn btn-success' role='button' style='margin: inherit;'>Info</a></td>";
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