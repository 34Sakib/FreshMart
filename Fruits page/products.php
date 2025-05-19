<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Redirect to login if trying to access cart-related functions without being logged in
if (isset($_POST['item_name']) && !isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// Sample product data
$products = [
  ['name' => 'Apple', 'price' => 1.99, 'category' => 'fruit', 'image' => 'https://civileats.com/wp-content/uploads/2016/12/applesheirloom.jpg'],
  ['name' => 'Banana', 'price' => 0.99, 'category' => 'fruit', 'image' => 'https://s1.1zoom.me/big3/392/427944-Kycb.jpg'],
  ['name' => 'Carrot', 'price' => 0.49, 'category' => 'vegetable', 'image' => 'https://hips.hearstapps.com/hmg-prod/images/carrots-royalty-free-image-1684505309.jpg'],
  ['name' => 'Tomato', 'price' => 1.49, 'category' => 'vegetable', 'image' => 'https://www.foodrepublic.com/img/gallery/13-things-you-didnt-know-about-tomatoes/l-intro-1684521109.jpg'],
  ['name' => 'Orange', 'price' => 1.29, 'category' => 'fruit', 'image' => 'https://cookingchew.com/wp-content/uploads/2023/09/How-To-Tell-If-A-Clementine-Is-Bad-CO3097-Pin-3-min.jpg.webp'],
  ['name' => 'Broccoli', 'price' => 1.99, 'category' => 'vegetable', 'image' => 'https://www.healthifyme.com/blog/wp-content/uploads/2018/07/Broccoli.jpeg'],
];

// Search functionality
$search = '';
if (isset($_GET['search'])) {
  $search = strtolower($_GET['search']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - FreshMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
  <style>
    .login-alert {
      background: linear-gradient(135deg, #ff9966, #ff5e62);
      color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .login-alert a {
      color: white;
      text-decoration: underline;
      font-weight: bold;
    }
    .card {
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .btn-add-to-cart {
      background: linear-gradient(135deg, #4CAF50, #81C784);
      border: none;
      transition: all 0.3s ease;
    }
    .btn-add-to-cart:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
    }
    .btn-disabled {
      background: #cccccc !important;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">FreshMart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">🏠 Home</a>
          </li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">🛒 Cart (<?php echo count($_SESSION['cart']); ?>)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5" style="padding-top: 80px;">
    <h2>Our Products</h2>

    <!-- Search Bar -->
    <form action="products.php" method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for fruits and vegetables..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>

    <?php if (!isset($_SESSION['user_id'])): ?>
      <div class="login-alert">
        <p>You need to <a href="login.php">login</a> to add items to your cart and make purchases.</p>
      </div>
    <?php endif; ?>

    <!-- Product List -->
    <div class="row">
      <?php foreach ($products as $product): ?>
        <?php if (empty($search) || strpos(strtolower($product['name']), $search) !== false): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="height: 200px; object-fit: cover;">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text">$<?php echo number_format($product['price'], 2); ?></p>
                <form action="add_to_cart.php" method="POST" class="mt-auto">
                  <input type="hidden" name="item_name" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="item_price" value="<?php echo $product['price']; ?>">
                  <button type="submit" class="btn btn-add-to-cart <?php echo !isset($_SESSION['user_id']) ? 'btn-disabled' : ''; ?>" <?php echo !isset($_SESSION['user_id']) ? 'disabled' : ''; ?>>
                    <?php echo isset($_SESSION['user_id']) ? 'Add to Cart' : 'Login to Add'; ?>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>