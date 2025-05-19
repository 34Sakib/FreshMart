<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch();

        if ($user) {
            $error = 'Username or email already exists';
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - FreshMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <style>
        .signup-container {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            margin: 50px auto;
            color: white;
        }
        .signup-container h2 {
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
        }
        .btn-signup {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-signup:hover {
            background-color: #1a252f;
            transform: translateY(-2px);
        }
        .login-link {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signup-container">
            <h2>Create Your Account</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-signup">Sign Up</button>
            </form>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="login.php" class="login-link">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>