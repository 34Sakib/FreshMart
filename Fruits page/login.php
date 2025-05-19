<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FreshMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <style>
        .login-container {
            background: linear-gradient(135deg, #81C784, #4CAF50);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            margin: 100px auto;
            color: white;
        }
        .login-container h2 {
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
        .btn-login {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #1a252f;
            transform: translateY(-2px);
        }
        .signup-link {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Welcome Back!</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="signup.php" class="signup-link">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>