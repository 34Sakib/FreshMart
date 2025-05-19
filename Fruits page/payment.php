<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment - FreshMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./style.css" rel="stylesheet" />
  <style>
    .payment-method-tabs .nav-link {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      color: #2c3e50;
      font-weight: 600;
      margin: 5px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .payment-method-tabs .nav-link.active {
      background-color: #3498db;
      color: white;
      border-color: #3498db;
    }

    .payment-method-tabs .nav-link:hover {
      background-color: #2980b9;
      color: white;
    }

    .payment-form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .payment-form h4 {
      color: #2c3e50;
      margin-bottom: 20px;
    }

    .payment-form .btn-primary {
      background-color: #3498db;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    .payment-form .btn-primary:hover {
      background-color: #2980b9;
    }

    .payment-logo {
      width: 30px;
      height: auto;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <h2 class="text-center mb-4" style="color: #2c3e50;">Payment</h2>

    <!-- Payment Method Tabs -->
    <ul class="nav nav-pills payment-method-tabs justify-content-center" id="paymentTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="bkash-tab" data-bs-toggle="pill" data-bs-target="#bkash" type="button" role="tab">
          <img src="https://freelogopng.com/images/all_img/1656234782bkash-app-logo.png" alt="bKash" class="payment-logo" />
          bKash
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="nagad-tab" data-bs-toggle="pill" data-bs-target="#nagad" type="button" role="tab">
          <img src="https://freelogopng.com/images/all_img/1679248828Nagad-Logo-PNG.png" alt="Nagad" class="payment-logo" />
          Nagad
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="rocket-tab" data-bs-toggle="pill" data-bs-target="#rocket" type="button" role="tab">
          <img src="https://bestlistbd.com/wp-content/uploads/classified-listing/2021/06/56191305_1074649016065535_8893606934653960192_n-1.jpg" alt="Rocket" class="payment-logo" />
          Rocket
        </button>
      </li>
    </ul>

    <!-- Payment Forms -->
    <div class="tab-content mt-4" id="paymentTabsContent">
      <!-- bKash -->
      <div class="tab-pane fade show active payment-form" id="bkash" role="tabpanel">
        <h4>Pay with bKash</h4>
        <form action="process_payment.php" method="POST">
          <input type="hidden" name="payment_method" value="bkash" />
          <div class="mb-3">
            <label for="bkashNumber" class="form-label">bKash Number</label>
            <input type="text" pattern="\d{11}" maxlength="11" class="form-control" id="bkashNumber" name="bkash_number" placeholder="01XXXXXXXXX" required title="Enter exactly 11 digit number" />
          </div>
          <div class="mb-3">
            <label for="bkashPin" class="form-label">bKash PIN</label>
            <input type="password" pattern="\d{5}" maxlength="5" class="form-control" id="bkashPin" name="bkash_pin" placeholder="PIN" required title="Enter 5 digit PIN" />
          </div>
          <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
      </div>

      <!-- Nagad -->
      <div class="tab-pane fade payment-form" id="nagad" role="tabpanel">
        <h4>Pay with Nagad</h4>
        <form action="process_payment.php" method="POST">
          <input type="hidden" name="payment_method" value="nagad" />
          <div class="mb-3">
            <label for="nagadNumber" class="form-label">Nagad Number</label>
            <input type="text" pattern="\d{11}" maxlength="11" class="form-control" id="nagadNumber" name="nagad_number" placeholder="01XXXXXXXXX" required title="Enter exactly 11 digit number" />
          </div>
          <div class="mb-3">
            <label for="nagadPin" class="form-label">Nagad PIN</label>
            <input type="password" pattern="\d{5}" maxlength="5" class="form-control" id="nagadPin" name="nagad_pin" placeholder="PIN" required title="Enter 5 digit PIN" />
          </div>
          <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
      </div>

      <!-- Rocket -->
      <div class="tab-pane fade payment-form" id="rocket" role="tabpanel">
        <h4>Pay with Rocket</h4>
        <form action="process_payment.php" method="POST">
          <input type="hidden" name="payment_method" value="rocket" />
          <div class="mb-3">
            <label for="rocketNumber" class="form-label">Rocket Number</label>
            <input type="text" pattern="\d{11}" maxlength="11" class="form-control" id="rocketNumber" name="rocket_number" placeholder="01XXXXXXXXX" required title="Enter exactly 11 digit number" />
          </div>
          <div class="mb-3">
            <label for="rocketPin" class="form-label">Rocket PIN</label>
            <input type="password" pattern="\d{5}" maxlength="5" class="form-control" id="rocketPin" name="rocket_pin" placeholder="PIN" required title="Enter 5 digit PIN" />
          </div>
          <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
