<?php
\Stripe\Stripe::setApiKey('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');

// Authenticate your user.
$session = \Stripe\BillingPortal\Session::create([
  'customer' => 'cus_LBTIj5VgikBKjO',
  'return_url' => 'https://dev.cine-plus.nl',
]);

// Redirect to the customer portal.
header("Location: " . $session->url);
exit();
?>