<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FreshMart - Buy Fresh Fruits & Vegetables</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png" alt="FreshMart Logo" width="40" height="40" class="d-inline-block align-top me-2">
          <span class="brand-text">Fresh<span>Mart</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#home"><i class="fas fa-home me-1"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about"><i class="fas fa-info-circle me-1"></i> About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.php"><i class="fas fa-shopping-basket me-1"></i> Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact"><i class="fas fa-envelope me-1"></i> Contact</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                  <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['username']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="cart.php"><i class="fas fa-shopping-cart me-2"></i> Cart (<span class="cart-indicator"><?php echo count($_SESSION['cart']); ?></span>)</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link btn-login" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
<section id="home" class="hero">
  <div class="hero-content animate-on-scroll">
    <h1>Farm Fresh Delivered</h1>
    <p class="lead">Organic fruits & vegetables straight from local farms</p>
    <div class="hero-btns">
      <a href="products.php" class="btn btn-primary btn-lg me-3">
        <i class="fas fa-shopping-basket me-2"></i> Shop Now
      </a>
      <a href="#about" class="btn btn-outline-light btn-lg">
        <i class="fas fa-leaf me-2"></i> Learn More
      </a>
    </div>
  </div>
  <div class="hero-overlay"></div>
</section>

    <!-- About Section -->
    <section id="about" class="about-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 animate-on-scroll">
            <h2>Our Story</h2>
            <p>
              FreshMart is dedicated to providing the freshest fruits and vegetables
              straight from the farm to your table. We believe in quality, freshness,
              and sustainability.
            </p>
            <p>
              Our mission is to make healthy eating accessible and convenient for everyone.
            </p>
          </div>
          <div class="col-lg-6 animate-on-scroll">
            <div class="about-image">
              <img
                src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                alt="Fresh fruits and vegetables"
                class="img-fluid rounded"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section bg-gradient text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-6 animate-on-scroll">
            <h2>Contact Us</h2>
            <div class="contact-info">
              <p><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</p>
              <p><i class="fas fa-phone"></i> +880 123 456 7890</p>
              <p><i class="fas fa-envelope"></i> sakibalmahamud34@gmail.com</p>
            </div>
          </div>
          <div class="col-md-6 animate-on-scroll">
            <form class="contact-form needs-validation" novalidate>
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Your Name" required>
                <div class="invalid-feedback">Please enter your name</div>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Your Email" required>
                <div class="invalid-feedback">Please enter a valid email</div>
              </div>
              <div class="mb-3">
                <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
                <div class="invalid-feedback">Please enter your message</div>
              </div>
              <button type="submit" class="btn btn-light text-primary">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>FreshMart</h3>
            <p>Freshness delivered to your doorstep</p>
          </div>
          <div class="col-md-4">
            <h3>Follow Us</h3>
            <div class="social-links">
              <a href="#" data-bs-toggle="tooltip" title="Facebook"><i class="fab fa-facebook"></i></a>
              <a href="#" data-bs-toggle="tooltip" title="Instagram"><i class="fab fa-instagram"></i></a>
              <a href="#" data-bs-toggle="tooltip" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
          <div class="col-md-4">
            <h3>Newsletter</h3>
            <form class="newsletter-form">
              <input
                type="email"
                placeholder="Your email"
                class="form-control"
              />
              <button type="submit" class="btn btn-primary mt-2">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 text-center">
            <p>&copy; 2025 FreshMart. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Navbar scroll effect
      const navbar = document.querySelector('.navbar');
      
      window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });

      // Initialize Bootstrap tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      // Form validation
      const forms = document.querySelectorAll('.needs-validation');
      
      forms.forEach(form => {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          
          const targetId = this.getAttribute('href');
          if (targetId === '#') return;
          
          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            window.scrollTo({
              top: targetElement.offsetTop - 80,
              behavior: 'smooth'
            });
            
            // Update URL without jumping
            if (history.pushState) {
              history.pushState(null, null, targetId);
            }
          }
        });
      });

      // Animation on scroll
      const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        
        elements.forEach(element => {
          const elementPosition = element.getBoundingClientRect().top;
          const windowHeight = window.innerHeight;
          
          if (elementPosition < windowHeight - 100) {
            element.classList.add('animated');
          }
        });
      };

      // Run once on page load
      animateOnScroll();
      window.addEventListener('scroll', animateOnScroll);
    });
    </script>
  </body>
</html>