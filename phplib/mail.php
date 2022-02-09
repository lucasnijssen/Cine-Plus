<?php
  error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
  require_once "Mail.php";
  require_once "./mailconfig.php";
  $to = $username;
  $email_from = "Cine-Plus <welcome@registration.cine-plus.nl>";
  $email_subject = "Welkom bij Cine-Plus" ;
  $email_body = '<p>Welkom ' . $username . ' bij Cine-Plus<p><br>Je account is successvol aangemaakt!';
  $email_address = "welcome@registration.cine-plus.nl";

  $headers = array ('Content-type' => 'text/html;charset=iso-8859-1', 'From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
  $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $usname, 'password' => $password));
  $mail = $smtp->send($to, $headers, $email_body);
?>