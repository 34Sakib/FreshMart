<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$item = [
    'name' => $_POST['item_name'],
    'price' => $_POST['item_price']
];

$_SESSION['cart'][] = $item;

header('Location: products.php');
exit;
?>