<?php
//AuditLog start
$audit_user = $gebruikersid;
$audit_actie = "Bericht verzonden";
if($new_afzender == "s"){
    $audit_info = "Bericht verstuurd aan " . $new_usermail . " als Systeem";
}else{
    $audit_info = "Bericht verstuurd aan " . $new_usermail . ".";
}
echo '<script>ws.send(JSON.stringify({ id: "audit-log", user: ' . $audit_user . ', actie: ' . $audit_actie . ', actie: ' . $audit_info . ' }));</script>';
//AuditLog 
?>