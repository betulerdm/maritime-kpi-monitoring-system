<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Şikayet Formu Giriş - Erdem Marine</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .background {
      background-image: url('images/complaint_bg.jpg'); /* kendi görselini buraya ekle */
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .overlay {
      background-color: rgba(0,0,0,0.6);
      padding: 40px;
      border-radius: 15px;
      text-align: center;
      color: white;
    }

    .logo {
      width: 200px;
      margin-bottom: 30px;
    }

    .btn {
      background-color: #00bfff;
      color: white;
      padding: 15px 30px;
      text-decoration: none;
      border-radius: 30px;
      font-size: 18px;
      transition: 0.3s;
      display: inline-block;
    }

    .btn:hover {
      background-color: #007bb5;
    }
  </style>
</head>
<body>

<div class="background">
  <div class="overlay">
    <img src="images/formlo.png" alt="Erdem Marine Logo" class="logo">
    <h2>Şikayet Formu için Tıklayın</h2>
    <a href="complaints_form.php" class="btn">📨 Şikayet Formu</a>
  </div>
</div>

</body>
</html>
