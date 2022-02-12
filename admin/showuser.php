<!DOCTYPE html>

<?php 
include_once("../phplib/config.php");
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mid = $_GET["id"];
$sql = "select * from users WHERE id = $mid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $usr_rang = $row["ranglevel"];
        $usr_username = $row["username"];
        $usr_verify = $row["verify"];

        if($usr_verify == 0){
            $usr_verify_name = "Nee";
        }else{
            $usr_verify_name = "Ja";
        }

        if($usr_rang == 4){
            $usr_rang_name = "Gebruiker";
        }else if($usr_rang == 10){
            $usr_rang_name = "Admin";
        }else if($usr_rang < 4){
            $usr_rang_name = "Banned";
        }else{
            $usr_rang_name == "ERROR";
        }

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
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
                    <h3 class="text-dark mb-4"><?php echo $usr_username; ?></h3>
                    <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Gebruikersinformatie</h6>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label>Gebruikersnaam</label>
                                    <input type="email" class="form-control" name="username" value="<?php echo $usr_username; ?>">
                                </div><br>
                                <div class="form-group">
                                    <label>Rang</label>
                                    <select class="form-control" name="rang">
                                        <option value="<?php echo $usr_rang; ?>"><?php echo $usr_rang_name; ?></option>
                                        <option value="2">Banned</option>
                                        <option value="4">Gebruiker</option>
                                        <option value="10">Admin</option>
                                    </select>
                                </div><br>
                                <div class="form-group">
                                    <label>Titel</label>
                                    <select class="form-control" name="verify">
                                        <option value="<?php echo $usr_verify; ?>"><?php echo $usr_verify_name; ?></option>
                                        <option value="0">Nee</option>
                                        <option value="1">Ja</option>
                                    </select>
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
$usr_new_rang = $_POST["rang"];
$usr_new_username = $_POST["username"];
$usr_new_verify = $_POST["verify"];

if(empty($usr_new_username)){
    echo '<script>swal.fire("Er ging iets mis...", "Er is geen gebruikersnaam opgegeven.", "error");</script>';
    die();
}

if($usr_rang_name == "ERROR"){
    echo '<script>swal.fire("Er ging iets mis...", "De rangdata van de klant zijn niet goed geladen", "error");</script>';
    die();
}

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `users` SET `username`='$usr_new_username',`ranglevel`='$usr_new_rang',`verify`='$usr_new_verify' WHERE id=$mid";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
	echo '<meta http-equiv="refresh" content="0; url=#" />';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else{

}
?>