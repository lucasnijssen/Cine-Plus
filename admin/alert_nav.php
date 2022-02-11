<?php
    include_once("../phplib/config.php");
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select * from movies";
    $sql2 = "select * from movies";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    $alert_count = $result->num_rows;
    $message_count = $result2->num_rows;
?>




<li class="nav-item dropdown no-arrow mx-1">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php echo $alert_count; ?></span><i class="fas fa-bell fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6>
                <?php 
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                        echo '<div class="me-3">';
                        echo '<div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>';
                        echo '</div>';
                        echo '<div><span class="small text-gray-500">December 12, 2019</span>';
                        echo '<p>A new monthly report is ready to download!</p>';
                        echo '</div></a>';
                        }
                    } else {
                        echo '<div><span class="small text-gray-500">-</span>';
                        echo '<p>Geen nieuwe meldingen</p>';
                        echo '</div></a>';
                    }
                    $conn->close();
                ?>
        </div>
    </div>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php echo $message_count; ?></span><i class="fas fa-envelope fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <?php 
                    if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row = $result2->fetch_assoc()) {
                        echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                        echo '<div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">';
                        echo '</div>';
                        echo '<div class="fw-bold">';
                        echo '<div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem Ive been having.</span></div>';
                        echo '<p class="small text-gray-500 mb-0">Emily Fowler</p>';
                        echo '</div></a>';
                        }
                    } else {
                        echo '<div><span class="small text-gray-500">-</span>';
                        echo '<p>Geen nieuwe meldingen</p>';
                        echo '</div></a>';
                    }
                    $conn->close();
                ?>
        </div>
    </div>
    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
</li>