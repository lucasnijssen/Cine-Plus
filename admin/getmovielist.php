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
        echo "<td><a href='./show.php?id=" . $row["id"]. "' class='btn btn-success' role='button' style='margin: inherit;'>Info</a>";
        echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-product-id='" . $row["id"]. "' data-target='#verwijderProduct' style='margin: inherit;'>Verwijder</button></td>";
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
if (isset($_POST["confirm_delete"])) {
$deleteprod_id = $_POST["product_id"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `movies` WHERE `id` = $deleteprod_id";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
	echo '<meta http-equiv="refresh" content="0; url=#" />';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else{

}
?>

<div class="modal fade" id="verwijderProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verwijder Film</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form method="post" target="_self" style="width: 100%;height: auto;">
<p>Vink aan om verwijdering te bevestigen</p>
<input class="form-control" type="checkbox" name="confirm_delete" style="height:24px;" required="" value="">
<input class="form-control" type="hidden" id="product_id" name="product_id" value="">


      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit">Verwijder Film</button>
        </form>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuleer</button>
      </div>
    </div>
  </div>
</div>
<script>
$('#verwijderProduct').on('show.bs.modal', function(e) {
    var bookId = $(e.relatedTarget).data('product-id');
    $(e.currentTarget).find('input[name="product_id"]').val(bookId);
});
</script>