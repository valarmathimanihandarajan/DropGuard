<?php
session_start();
require_once 'includes/db_connect.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']); // now using the correct field name
  $password = $_POST['password'];

  // Use `name` column in the WHERE clause
  $stmt = $conn->prepare("SELECT id, password, name FROM users WHERE name = ?");
  if ($stmt) {
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($id, $hashed_password, $user_name);
      $stmt->fetch();

      if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $user_name;
        header("Location: dashboard.php");
        exit();
      } else {
        $error = "Invalid password.";
      }
    } else {
      $error = "User not found.";
    }
    $stmt->close();
  } else {
    $error = "Query error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - DropGuard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('images/women.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }

    .overlay {
      background-color: rgba(255, 255, 255, 0.88);
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }

    .login-container {
      position: relative;
      z-index: 2;
      width: 400px;
      margin: 80px auto;
      padding: 40px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      color: #8e24aa;
      margin-bottom: 25px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
      transition: border 0.3s;
    }

    input:focus {
      border-color: #8e24aa;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #8e24aa;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 10px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #6a1b9a;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }

    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .link a {
      color: #6a1b9a;
      font-weight: bold;
      text-decoration: none;
    }

    .link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="login-container">
    <h2>Login to DropGuard</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Enter your name" required>
      <input type="password" name="password" placeholder="Enter password" required>
      <button type="submit">Login</button>
    </form>
    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <div class="link">
      New here? <a href="register.php">Register Now</a>
    </div>
  </div>
</body>
</html>
