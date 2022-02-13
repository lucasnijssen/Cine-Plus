<?php
include_once("checkrank.php");
?>
<link rel="stylesheet" href="assets/bootstrap/css/custom.css">
<ul class="navbar-nav text-light" id="accordionSidebar">
    <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
    <li class="nav-item"><a class="nav-link" href="sendmessage.php"><i class="fas fa-envelope"></i><span>Bericht Sturen</span></a></li>

    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Dropdown </a>
        <div class="dropdown-menu"><a class="dropdown-item" href="sendmessage.php"><i class="fas fa-envelope"></i><span>Bericht Sturen</span></a>
    </li>

    <li class="nav-item"><a class="nav-link" href="movies.html"><i class="fas fa-table"></i><span>Films</span></a></li>
    <li class="nav-item"><a class="nav-link" href="users.html"><i class="fas fa-user"></i><span>Gebruikers</span></a></li>
    <?php if($usr_rank >= 15) : ?>
    <li class="nav-item"><a class="nav-link" href="sendAlert.html"><i class="fas fa-warning"></i><span>Systeem Alert</span></a></li>
    <?php endif; ?>
    <?php if($usr_rank >= 20) : ?>
    <li class="nav-item"><a class="nav-link" href="createAdminAlert.php"><i class="fas fa-gear"></i><span>Admin Alert</span></a></li>
    <?php endif; ?>
</ul>