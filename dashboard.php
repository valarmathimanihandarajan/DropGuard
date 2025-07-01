<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - DropGuard</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .navbar a {
      text-decoration: none;
      font-weight: bold;
      color: #6a1b9a;
      margin: 0 10px;
    }
    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #8e24aa;
      text-align: center;
      margin-bottom: 30px;
    }
    canvas {
      margin: 20px auto;
      display: block;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div><strong>DropGuard Dashboard</strong></div>
    <div>
      <a href="submit_incident.php">Report Incident</a>
      <a href="experience_wall.php">Experience Wall</a>
      <a href="quiz.php">Safety Quiz</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <canvas id="categoryChart" width="400" height="200"></canvas>
    <canvas id="timeChart" width="400" height="200"></canvas>
    <canvas id="zoneChart" width="400" height="200"></canvas>
  </div>

  <script>
    const categoryChart = new Chart(document.getElementById('categoryChart'), {
      type: 'bar',
      data: {
        labels: ['Harassment', 'Stalking', 'Eve-teasing', 'Others'],
        datasets: [{
          label: 'Number of Reports',
          data: [12, 19, 3, 5],
          backgroundColor: '#8e24aa'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });

    const timeChart = new Chart(document.getElementById('timeChart'), {
      type: 'line',
      data: {
        labels: ['6-9 AM', '9-12 PM', '12-3 PM', '3-6 PM', '6-9 PM', '9-12 AM'],
        datasets: [{
          label: 'Incidents by Time',
          data: [2, 4, 3, 8, 15, 10],
          backgroundColor: '#f06292',
          borderColor: '#ab47bc',
          fill: true,
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        }
      }
    });

    const zoneChart = new Chart(document.getElementById('zoneChart'), {
      type: 'doughnut',
      data: {
        labels: ['Zone A', 'Zone B', 'Zone C', 'Zone D', 'Zone E'],
        datasets: [{
          label: 'Unsafe Zone Reports',
          data: [5, 7, 9, 4, 6],
          backgroundColor: ['#f8bbd0', '#ce93d8', '#ba68c8', '#ab47bc', '#8e24aa']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>
</body>
</html>
