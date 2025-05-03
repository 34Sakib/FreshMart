<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
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
</head>
<body>
  <div class="container my-5">
    <h2>Our Products</h2>
    <!-- Search Bar -->
    <form action="products.php" method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for fruits and vegetables..." value="<?php echo $search; ?>">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
    <!-- Product List -->
    <div class="row">
      <?php foreach ($products as $product): ?>
        <?php if (empty($search) || strpos(strtolower($product['name']), $search) !== false): ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <!-- Product Image -->
              <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text">$<?php echo $product['price']; ?></p>
                <form action="add_to_cart.php" method="POST">
                  <input type="hidden" name="item_name" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="item_price" value="<?php echo $product['price']; ?>">
                  <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>