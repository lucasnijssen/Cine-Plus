<!-- Project: Cine-Plus. Code Author: Boyke van Vugt. -->
<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["zoek"]) || !empty($_POST["zoek"])){
    $zoek = $_POST["zoek"];
    $sql = "SELECT * FROM `movies` WHERE `title` LIKE '%" . $zoek . "%'";
}else{
    $sql = "SELECT * FROM `movies`";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td><a href="https://cine-plus.nl/player.html?iv=' . $row["movie_id"] .'" target="_blank"> ' . $row["movie_id"] . '</a></td>';
        echo '<td>' . $row["title"] . '</td>';
        echo '<td>' . $row["info"] . '</td>';
        echo '<td>' . $row["cdn"] . '</td>';
        echo "<td><a href='./show.php?id=" . $row["id"]. "' class='btn btn-success' role='button' style='margin: inherit;'>Info</a>";
        echo "<a href='?delmov=" . $row["id"]. "' class='btn btn-danger' role='button' style='margin: inherit;'>Delete</a></td>";
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

<?php
if (isset($_GET["delmov"])) {
$deleteprod_id = $_GET["delmov"];
// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `movies` WHERE `id` = $deleteprod_id";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
	echo "<script>Swal.fire({ icon: 'success', title: 'Film verwijderd', showConfirmButton: false, timer: 3000, }).then((result) => { let url = window.location.href; let red = url.replace('?delmov=". $deleteprod_id . "', ''); window.location.href = red; })</script>";
        //AuditLog start
        $audit_user = $gebruikersid;
        $audit_actie = "Verwijderde Film";
        $audit_info = "Gebruiker heeft de film een film verwijderd";
        include_once("./infogetters/aditlog.php");
        //AuditLog end
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else{

}
?>