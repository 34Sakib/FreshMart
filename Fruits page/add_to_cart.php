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

header('Location: index.php'); // Redirect back to the menu
exit;
?>