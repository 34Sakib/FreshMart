<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$index = $_POST['index'];
if (isset($_SESSION['cart'][$index])) {
  array_splice($_SESSION['cart'], $index, 1);
}

header('Location: cart.php'); // Redirect back to the cart
exit;
?>