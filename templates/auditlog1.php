<?php
//AuditLog start
$audit_user = $gebruikersid;
$audit_actie = "Bericht verzonden";
if($new_afzender == "s"){
    $audit_info = "Bericht verstuurd aan " . $new_usermail . " als Systeem";
}else{
    $audit_info = "Bericht verstuurd aan " . $new_usermail . ".";
}
include_once("./infogetters/aditlog.php");
//AuditLog end
?>