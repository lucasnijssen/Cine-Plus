<!-- Project: Cine-Plus. Code Author: Boyke van Vugt. -->
<!DOCTYPE html>

<?php 
include_once("../phplib/config.php");
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Alert sturen - Cine-Plus Admin</title>
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
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Cine-Plus Admin</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <?php include_once('nav.php'); ?>
                <?php
                if($usr_rank < 19){
                    header("location: index.html");
                }
                ?>
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
                    <h3 class="text-dark mb-4">Admin Alert Versturen</h3>
                    <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Bericht</h6>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post">
                            <div class="form-group">
                                    <label>Type Melding</label>
                                    <select class="form-control" required name="type">
                                        <option>Selecteer een type melding</option>
                                        <option value="info">Info</option>
                                        <option value="warning">Waarschuwing</option>
                                        <option value="calendar">Herinnering</option>
                                        <option value="close">Storing</option>
                                        <option value="cogs">Update</option>
                                        <option value="exclamation-circle">Belangrijk</option>
                                        <option value="hdd-o">Server Update</option>
                                    </select>
                                </div><br>
                                <div class="form-group">
                                    <label>Bericht Titel</label>
                                    <input type="text" class="form-control" required name="titel" maxlength="32" placeholder="Zet hier een korte titel neer">
                                </div><br>
                                <div class="form-group">
                                    <label>Bericht</label>
                                    <input type="text" class="form-control" required name="bericht" placeholder="Type hier een bericht">
                                </div><br>
                                <br><button type="submit" class="btn btn-primary">Verstuur</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Verzonden Alerts</h6>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Titel</th>
                                            <th>Text</th>
                                            <th>Icon</th>
                                            <th>Actie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include_once('./infogetters/getAdminAlerts.php'); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Titel</strong></td>
                                            <td><strong>Text</strong></td>
                                            <td><strong>Icon</strong></td>
                                            <td><strong>Actie</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright ?? Cine-Plus Admin 2022</span></div>
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
$new_title = $_POST["titel"];
$new_bericht = $_POST["bericht"];
$new_type = $_POST["type"];

if(empty($new_bericht)){
    echo '<script>swal.fire("Er ging iets mis...", "Een van de opgegevens blijkt leeg te zijn of niet te werken.", "error");</script>';
    die();
}

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO `admin_alerts`(`short`, `text`, `type`) VALUES ('$new_title','$new_bericht','$new_type')";
if ($conn->query($sql) === TRUE) {
    echo "<script>Swal.fire({ icon: 'success', title: 'Bericht Verzonden', showConfirmButton: false, timer: 3000, }).then((result) => { let url = window.location.href; let red = url.replace('#', ''); window.location.href = red; })</script>";
        //AuditLog start
        $audit_user = $gebruikersid;
        $audit_actie = "Admin alert verzonden";
        $audit_info = "Gebruiker verstuurde een alert met titel " . $new_title . ".";
        include_once("./infogetters/aditlog.php");
        //AuditLog end


} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>


