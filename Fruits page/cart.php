<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
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
  <title>Cart - FreshMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
  <!-- Custom CSS for Cart -->
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

    .btn-danger {
      background-color: #e74c3c;
      border: none;
      padding: 5px 15px;
      font-size: 0.9rem;
      transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
      background-color: #c0392b;
    }

    .btn-primary {
      background-color: #3498db;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <h2 class="text-center mb-4" style="color: #2c3e50;">Your Cart</h2>
    <div class="cart-items">
      <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center" role="alert">
          Your cart is empty. <a href="products.php" class="alert-link">Start shopping!</a>
        </div>
      <?php else: ?>
        <?php foreach ($cart as $index => $item): ?>
          <div class="cart-item d-flex justify-content-between align-items-center">
            <div>
              <span class="item-name"><?php echo $item['name']; ?></span>
              <span class="item-price">$<?php echo $item['price']; ?></span>
            </div>
            <form action="remove_from_cart.php" method="POST" style="display:inline;">
              <input type="hidden" name="index" value="<?php echo $index; ?>">
              <button type="submit" class="btn btn-danger">Remove</button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="cart-total">
      <h5>Total: <span class="total-price">$<?php echo number_format($total, 2); ?></span></h5>
    </div>
    <div class="text-center mt-4">
      <a href="products.php" class="btn btn-primary me-2">Continue Shopping</a>
      <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
  </div>
</body>
</html>