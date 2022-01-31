<?php
$variables = array();

$variables['klant'] = $username;

$template = file_get_contents("welkom.html");

foreach($variables as $key => $value)
{
    $template = str_replace('{{ '.$key.' }}', $value, $template);
}

  error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
  require_once "Mail.php";
  $host = "yeetz.ovh";
  $username = "welcome@registration.cine-plus.nl";
  $password = "zN7VYVLqtaLKm9t";
  $port = "587";
  $to = $username;
  $email_from = "Cine-Plus <welcome@registration.cine-plus.nl>";
  $email_subject = "Welkom bij Cine-Plus" ;
  $email_body = $template;
  $email_address = "welcome@registration.cine-plus.nl";

  $headers = array ('Content-type' => 'text/html;charset=iso-8859-1', 'From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
  $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
  $mail = $smtp->send($to, $headers, $email_body);


  if (PEAR::isError($mail)) {
    echo("<p>" . $mail->getMessage() . "</p>");
    } else {
      echo '<script language="javascript">';
      echo 'alert("mail is verzonden naar ' . $username . '")';
      echo '</script>';
      echo "<script type='text/javascript'>window.close();</script>";
    }

?>