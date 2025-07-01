<?php
session_start();
require_once 'includes/db_connect.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "Registration successful. You can now <a href='login.php'>Login</a>.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - DropGuard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: url('images/women.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Montserrat', sans-serif;
    }
    .form-container {
      max-width: 400px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      backdrop-filter: blur(4px);
    }
    h2 {
      text-align: center;
      color: #8e24aa;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
    }
    input[type="text"], input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      background-color: #8e24aa;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      width: 100%;
      transition: 0.3s ease-in-out;
    }
    button:hover {
      background-color: #6a1b9a;
      transform: scale(1.05);
    }
    .message {
      margin-top: 20px;
      color: green;
      text-align: center;
    }
    .nav-link {
      display: block;
      margin-top: 15px;
      text-align: center;
      color: #444;
    }
    .nav-link a {
      color: #6a1b9a;
      text-decoration: none;
      font-weight: bold;
    }
    .nav-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <form method="POST" action="">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Register</button>
    </form>
    <div class="message"><?= $message ?></div>
    <div class="nav-link">Already have an account? <a href="login.php">Login</a></div>
    <div class="nav-link"><a href="index.php">⬅ Back to Home</a></div>
  </div>
</body>
</html>
