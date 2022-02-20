<?php

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('pk_test_51KV5gDC4DanyFX8I5u6Dp96HzZ8782djgNIDbgVtYLBZAmbNGBKveEMNcBvTehDFeOpMQLkNDXRWpjQJzNjU2DjS007p8cLjRu');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242/public';

try {
  $prices = \Stripe\Price::all([
    // retrieve lookup_key from form data POST body
    'lookup_keys' => ['basic'],
    'expand' => ['data.product']
  ]);

  $checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
      'price' => $prices->data[0]->id,
      'quantity' => 1,
    ]],
    'mode' => 'subscription',
    'success_url' => $YOUR_DOMAIN . '/success.html?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
    'subscription_data' => [
        'trial_period_days' => 14,
      ],
  ]);

  header("HTTP/1.1 303 See Other");
  header("Location: " . $checkout_session->url);
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>