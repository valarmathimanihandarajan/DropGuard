<!-- DropGuard: Women Safety Risk Analytics Portal (Visually Enhanced Index Page with Background Image) -->
<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropGuard | Safety Analytics Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }
        body {
            background: url('images/women.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }
        h1 {
            font-size: 2.8rem;
            color: #d81b60;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .btn {
            background-color: #8e24aa;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .btn:hover {
            background-color: #6a1b9a;
            transform: scale(1.05);
        }
        .quote {
            font-style: italic;
            font-size: 1rem;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to DropGuard</h1>
        <p>Your safety. Our mission. Empowering voices for safer communities.</p>
        <div class="btn-container">
            <a href="register.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>
        </div>
        <p class="quote">"Safety is not just a right — it's a shared responsibility."</p>
    </div>
</body>
</html>