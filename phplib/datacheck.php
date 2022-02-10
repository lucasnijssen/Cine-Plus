<?php ##Check the status of the user
require_once "config.php";
    $gebruikersid = $_SESSION["id"];
    $sql = "select * from users WHERE id = '$gebruikersid'";
    $result = $link->query($sql);
    if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $verstat = $row["verify"]; } } else { }
    $conn->close();

    if($verstat == 1){
        header("location: verify.html");
    }else{

    }
?>