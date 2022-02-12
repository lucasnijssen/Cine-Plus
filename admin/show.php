<!DOCTYPE html>

<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mid = $_GET["id"];
$sql = "select * from movies WHERE id = $mid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $mov_title = $row["title"];
        $mov_cdn = $row["cdn"];
        $mov_cover = $row["cover"];
        $mov_background = $row["image"];
        $mov_info = $row["info"];
    }
} else {

}
$conn->close();
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $mov_title; ?> - Cine-Plus Admin</title>
    <meta name="description" content="Administratie pagina van Cine-Plus">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #a50300;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Cine-Plus Admin</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <?php include_once('nav.php'); ?>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <?php include_once('alert_nav.php'); ?>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"><?php echo $mov_title; ?></h3>
                    <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Filminformatie</h6>
                        </div>
                        <div class="card-body">
                            <p>Ja heel mooi, alles staat er, niks werkt kwa opslaan. Mooi dat was m, fijn weekend!</p>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label>Titel</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $mov_title; ?>">
                                </div><br>
                                <div class="form-group">
                                    <label>INFO</label>
                                    <input type="url" class="form-control" name="info" value="<?php echo $mov_info; ?>">
                                </div><br>
                                <div class="form-group">
                                    <label>CDN</label>
                                    <input type="url" class="form-control" name="cdn" value="<?php echo $mov_cdn; ?>">
                                </div><br>
                                <div class="form-group">
                                    <label>Cover Image (Small)</label>
                                    <input type="url" class="form-control" name="cover" value="<?php echo $mov_cover; ?>">
                                    <small class="form-text text-muted"><img style="max-width: 10%;" src=<?php echo $mov_cover; ?>></small>
                                </div><br>
                                <div class="form-group">
                                    <label>Popup Background</label>
                                    <input type="url" class="form-control" name="background" value="<?php echo $mov_background; ?>">
                                    <small class="form-text text-muted"><img style="max-width: 20%;" src=<?php echo $mov_background; ?>></small>
                                </div>
                                <br><button type="submit" class="btn btn-primary">Opslaan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Cine-Plus Admin 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$mov_new_title = $_GET["title"];
$mov_new_cdn = $_GET["cdn"];
$mov_new_info = $_GET["info"];
$mov_new_cover = $_GET["cover"];
$mov_new_background = $_GET["background"];

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `movies` SET `cover`='$mov_new_cover',`cdn`='$mov_new_cdn',`title`='$mov_new_title',`image`='$mov_new_background',`info`='$mov_new_info' WHERE 1";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
	echo '<meta http-equiv="refresh" content="0; url=#" />';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else{

}
?>