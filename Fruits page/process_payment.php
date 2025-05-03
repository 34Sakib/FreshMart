<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  header('Location: cart.php'); // Redirect if cart is empty
  exit;
}

$payment_method = $_POST['payment_method'];

if ($payment_method === 'bkash') {
  // Simulate bKash payment processing
  $bkash_number = $_POST['bkash_number'];
  $bkash_pin = $_POST['bkash_pin'];

  // Validate bKash details (simulated)
  if (!empty($bkash_number) && !empty($bkash_pin)) {
    // Payment successful
    unset($_SESSION['cart']);
    header('Location: success.php');
    exit;
  } else {
    // Payment failed
    header('Location: payment.php?error=Invalid bKash details');
    exit;
  }
} elseif ($payment_method === 'nagad') {
  // Simulate Nagad payment processing
  $nagad_number = $_POST['nagad_number'];
  $nagad_pin = $_POST['nagad_pin'];

  // Validate Nagad details (simulated)
  if (!empty($nagad_number) && !empty($nagad_pin)) {
    // Payment successful
    unset($_SESSION['cart']);
    header('Location: success.php');
    exit;
  } else {
    // Payment failed
    header('Location: payment.php?error=Invalid Nagad details');
    exit;
  }
} elseif ($payment_method === 'rocket') {
  // Simulate Rocket payment processing
  $rocket_number = $_POST['rocket_number'];
  $rocket_pin = $_POST['rocket_pin'];

  // Validate Rocket details (simulated)
  if (!empty($rocket_number) && !empty($rocket_pin)) {
    // Payment successful
    unset($_SESSION['cart']);
    header('Location: success.php');
    exit;
  } else {
    // Payment failed
    header('Location: payment.php?error=Invalid Rocket details');
    exit;
  }
} else {
  // Invalid payment method
  header('Location: payment.php?error=Invalid payment method');
  exit;
}
?>