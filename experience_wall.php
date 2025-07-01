<?php
session_start();
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $experience = trim($_POST['experience']);
  $username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Anonymous';

  if (!empty($experience)) {
    $stmt = $conn->prepare("INSERT INTO experiences (username, message, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $username, $experience);
    $stmt->execute();
    $stmt->close();
  }
}

// Fetch posts
$sql = "SELECT username, message, created_at FROM experiences ORDER BY created_at DESC";
$result = $conn->query($sql);
$posts = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Experience Wall - DropGuard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('images/women.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0; padding: 0;
      color: #333;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: rgba(255,255,255,0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      margin-top: 40px;
    }
    h1 {
      text-align: center;
      color: #8e24aa;
    }
    form textarea {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      resize: vertical;
    }
    .btn-submit {
      background-color: #8e24aa;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }
    .post {
      margin-top: 25px;
      background: #f3e5f5;
      padding: 15px;
      border-radius: 10px;
    }
    .meta {
      font-size: 13px;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Share Your Experience</h1>
    <form method="POST">
      <textarea name="experience" rows="5" placeholder="Your story might help someone feel less alone..." required></textarea><br>
      <button class="btn-submit" type="submit">Post Anonymously</button>
    </form>

    <?php if (!empty($posts)): ?>
      <h2 style="margin-top: 40px;">Wall of Voices</h2>
      <?php foreach ($posts as $p): ?>
        <div class="post">
          <div class="meta"><strong><?= htmlspecialchars($p['username']) ?></strong> — <?= date("M d, Y h:i A", strtotime($p['created_at'])) ?></div>
          <p><?= nl2br(htmlspecialchars($p['message'])) ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No posts yet. Be the first to share.</p>
    <?php endif; ?>
  </div>
</body>
</html>
