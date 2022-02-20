<?php
    include_once("../phplib/config.php");
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select * from admin_alerts";
    $sql2 = "select * from admin_messages WHERE getter='$gebruikersid' AND readed != 1";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    $alert_count = $result->num_rows;
    $message_count = $result2->num_rows;
?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<li class="nav-item dropdown no-arrow mx-1">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
        <?php 
        if($alert_count > 0){
            echo '<span class="badge bg-danger badge-counter">';
            echo $alert_count; 
            echo '</span>';
        }
        ?><i class="fas fa-bell fa-fw"></i></a>
        <div style="background:mintcream;" class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6>
                <?php 
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<a style="background:mintcream;color:black!important" class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="swal.fire(`' . $row["short"] . '`, `' . $row["text"] . '`);">';
                        echo '<div class="me-3">';
                        echo '<div class="bg-primary icon-circle"><i style="margin-right:0rem;" class="fas fa-' . $row["type"] . ' text-white"></i></div>';
                        echo '</div>';
                        $date = date('F j Y', strtotime($row["datum"]));
                        echo '<div><span class="small text-gray-500">' . $date . '</span>';
                        echo '<p>'. $row["short"] . '</p>';
                        echo '</div></a>';
                        }
                    } else {
                        echo '<a style="background:mintcream;color:black!important" class="dropdown-item d-flex align-items-center" href="javascript:void(0);">';
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
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
    <?php 
        if($message_count > 0){
            echo '<span class="badge bg-danger badge-counter">';
            echo $message_count; 
            echo '</span>';
        }
        ?></span><i class="fas fa-envelope fa-fw"></i></a>
        <div  class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6>
                <?php 
                    if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row = $result2->fetch_assoc()) {
                        echo '<a style="background:mintcream;color:black!important" class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="Swal.fire({ title: `' . $row["message_short"] . '`,text: `' . $row["message"] . '`, showConfirmButton: true}).then((result) => { ws.send(JSON.stringify({ id: `admin-message-read`, message_id: `' . $row["id"] . '` })); let url = window.location.href; let red = url.replace(`#`, ``); window.location.href = red; })">';
                        echo '<div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">';
                        echo '</div>';
                        echo '<div class="fw-bold">';
                        echo '<div class="text-truncate"><span>' . $row["message_short"] . '</span></div>';

                        $senderid = $row["user"];
                        $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
                        if($senderid == "s"){
                            $sendername = "Systeem";
                            $conn->close();
                        }else{
                            $sql3 = "select * from users WHERE id=$senderid";
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) {
                                while($row = $result3->fetch_assoc()) {
                                    $sendername = $row["username"];
                                    }
                                } else {
                                    $sendername = "Onbekend";
                                }
                                $conn->close();
                        }

                        echo '<p class="small text-gray-500 mb-0">Van: ' . $sendername . '</p>';
                        echo '</div></a>';
                        }
                    } else {
                        echo '<a style="background:mintcream;color:black!important" class="dropdown-item d-flex align-items-center" href="javascript:void(0);">';
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
<div class="d-none d-sm-block topbar-divider"></div>
<li class="nav-item dropdown no-arrow">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $usr_name; ?></span><img class="border rounded-circle img-profile" src="https://cine-plus.nl/images/netflix-avatar.png"></a>
        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="auditlog.html"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="/"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Back to site</a>
        </div>
    </div>
</li>
<script src="JS/socket.js?v=2"></script>