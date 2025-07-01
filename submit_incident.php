<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
require_once 'includes/db_connect.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $place = trim($_POST['place']);
  $date = $_POST['date'];
  $time = $_POST['time'];
  $category = $_POST['category'];
  $severity = $_POST['severity'];
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("INSERT INTO incidents (user_id, place, date, time, category, severity) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("isssss", $user_id, $place, $date, $time, $category, $severity);
  if ($stmt->execute()) {
    $message = "Incident reported successfully.";
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
  <title>Report Incident - DropGuard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: url('images/women.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .navbar a {
      text-decoration: none;
      font-weight: bold;
      color: #6a1b9a;
      margin: 0 10px;
    }
    .form-container {
      max-width: 500px;
      margin: 50px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    h2 {
      color: #8e24aa;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      background-color: #8e24aa;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      width: 100%;
      margin-top: 15px;
      transition: 0.3s;
    }
    button:hover {
      background-color: #6a1b9a;
      transform: scale(1.02);
    }
    .message {
      margin-top: 20px;
      color: green;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div><strong>DropGuard</strong></div>
    <div>
      <a href="dashboard.php">Dashboard</a>
      <a href="experience_wall.php">Experience Wall</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
  <div class="form-container">
    <h2>Report an Incident</h2>
    <form method="POST">
      <div class="form-group">
        <label for="place">Place</label>
        <input type="text" id="place" name="place" required>
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="time">Time</label>
        <input type="time" id="time" name="time" required>
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="Harassment">Harassment</option>
          <option value="Stalking">Stalking</option>
          <option value="Eve-teasing">Eve-teasing</option>
          <option value="Others">Others</option>
        </select>
      </div>
      <div class="form-group">
        <label for="severity">Severity</label>
        <select id="severity" name="severity" required>
          <option value="Low">Low</option>
          <option value="Medium">Medium</option>
          <option value="High">High</option>
        </select>
      </div>
      <button type="submit">Submit Report</button>
    </form>
    <div class="message"><?php echo $message; ?></div>
  </div>
</body>
</html>
