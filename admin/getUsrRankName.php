<?php
if($usr_rang == 4){
    $usr_rang_name = "Gebruiker";
}else if($usr_rang == 10){
    $usr_rang_name = "Admin";
}else if($usr_rang == 15){
    $usr_rang_name = "Super Admin";
}else if($usr_rang == 20){
    $usr_rang_name = "Owner";
}else if($usr_rang < 4){
    $usr_rang_name = "Banned";
}else{
    $usr_rang_name == "ERROR";
}
?>