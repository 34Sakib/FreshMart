<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$item = [
  'name' => $_POST['item_name'],
  'price' => $_POST['item_price']
];

$_SESSION['cart'][] = $item;

// Redirect back to the product page after adding to cart
header('Location: products.php');
exit;
?>
