<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ERDEM MARINE - KPI System</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .logo-img {
      display: block;
      margin: 0 auto;
      width: 180px;
      height: auto;
      z-index: 2;
      position: relative;
    }

    .banner {
      position: relative;
      text-align: center;
      color: white;
    }

    .banner::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-image: url('images/your-background.jpg'); /* kendi görselinle değiştir */
      background-size: cover;
      background-position: center;
      z-index: 0;
      opacity: 1;
    }

    .banner .content {
      position: relative;
      z-index: 1;
      padding: 100px 20px;
    }

    .btn {
      display: inline-block;
      margin: 10px;
      padding: 10px 20px;
      background-color: #00aaff;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 30px;
      background-color: #003366;
      color: white;
    }

    .menu {
      list-style: none;
      display: flex;
      gap: 15px;
    }

    .menu li a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo">ERDEM MARINE</div>
  <ul class="menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="register.php">Register</a></li>
  </ul>
</nav>



<!-- BANNER -->
<section class="banner">
  <div class="content">
    <h1>Maritime KPI Tracking System</h1>
    <p>Operational Management and Reporting</p>
    <a href="login.php" class="btn">Login</a>
    <a href="register.php" class="btn">Register</a>
  </div>
</section>

</body>
</html>
