<!-- Project: Cine-Plus. Code Author: Boyke van Vugt. -->
<?php
header('Access-Control-Allow-Origin: *', false);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

$con = mysqli_connect('db2.dixiehosting.nl','cineplus','xCibCzUgW9bj8BQ4','lucasnijssen_cineplus');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM `movies` WHERE `cat` LIKE '%horror%'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
  echo '<a id="test" class="triggerModal" onclick="createModal(`' . $row['movie_id'] . '`)"> <img class="row__poster row_posterLarge" src="' . $row['cover'] . '" alt="" /></a>';
}
mysqli_close($con);
?>
</body>
</html>

