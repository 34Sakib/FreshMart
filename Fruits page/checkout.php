<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  header('Location: cart.php'); // Redirect if cart is empty
  exit;
}

$cart = $_SESSION['cart'];
$total = 0;

foreach ($cart as $item) {
  $total += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - FreshMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
  <!-- Custom CSS for Checkout -->
  <style>
    .cart-item {
      background: linear-gradient(135deg, #f9f9f9, #ffffff);
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cart-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .item-name {
      font-size: 1.2rem;
      font-weight: 600;
      color: #2c3e50;
    }

    .item-price {
      font-size: 1.1rem;
      font-weight: 700;
      color: #27ae60;
    }

    .cart-total {
      background: linear-gradient(135deg, #27ae60, #2ecc71);
      color: white;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      text-align: center;
    }

    .cart-total h5 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
    }

    .total-price {
      font-size: 1.8rem;
      color: #f1c40f;
    }

    .btn-primary {
      background-color: #3498db;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      width: 100%;
      max-width: 300px;
      margin: 20px auto;
      display: block;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    .checkout-header {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    .checkout-header h2 {
      font-size: 2.5rem;
      font-weight: 700;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <!-- Checkout Header -->
    <div class="checkout-header">
      <h2>Checkout</h2>
      <p class="lead">Review your order and proceed to payment.</p>
    </div>

    <!-- Cart Items -->
    <div class="cart-items">
      <?php foreach ($cart as $item): ?>
        <div class="cart-item d-flex justify-content-between align-items-center">
          <span class="item-name"><?php echo $item['name']; ?></span>
          <span class="item-price">$<?php echo $item['price']; ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Cart Total -->
    <div class="cart-total">
      <h5>Total: <span class="total-price">$<?php echo number_format($total, 2); ?></span></h5>
    </div>

    <!-- Pay Now Button -->
    <form action="payment.php" method="POST">
      <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
  </div>
</body>
</html>