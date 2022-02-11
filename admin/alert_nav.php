

<li class="nav-item dropdown no-arrow mx-1">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6>
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
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
            <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                    <div class="bg-success status-indicator"></div>
                </div>
                <div class="fw-bold">
                    <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                    <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                </div>
            </a><a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                    <div class="status-indicator"></div>
                </div>
                <div class="fw-bold">
                    <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                    <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                </div>
            </a><a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                    <div class="bg-warning status-indicator"></div>
                </div>
                <div class="fw-bold">
                    <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                    <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                </div>
            </a><a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                    <div class="bg-success status-indicator"></div>
                </div>
                <div class="fw-bold">
                    <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                    <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                </div>
            </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
    </div>
    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
</li>