<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Supplier Form - Erdem Marine</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .tedarikci-banner {
      background-image: url('images/resim4.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      text-align: center;
    }

    .logo-img {
      display: block;
      margin: 0 auto 30px auto;
      width: 500px;
    }

    .register-form {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 60px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
      width: 700px;
      color: white;
      margin: 0 auto;
    }

    .register-form input,
    .register-form select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: none;
    }

    .register-form label {
      display: block;
      text-align: left;
      margin-top: 10px;
    }

    .btn {
      background-color: #00bfff;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 30px;
      margin-top: 15px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #007bb5;
    }
  </style>
</head>
<body>

<section class="tedarikci-banner">

  <div class="form-container">
    <!-- Logo -->
    <img src="images/formlo.png" alt="ERDEM MARINE Logo" class="logo-img">

    <!-- Form Box -->
    <div class="register-form">
      <h2>Supplier Information Form</h2>
      <form action="suppliers_kaydet.php" method="POST">

        <input type="text" name="firma_adi" placeholder="Company Name" required>
        <input type="text" name="adres" placeholder="Address" required>
        <input type="text" name="telefon" placeholder="Phone" required>

        <label for="iso9001">ISO 9001 Certificate:</label>
        <select name="iso9001" id="iso9001" required>
          <option value="VAR">Available</option>
          <option value="YOK">Not Available</option>
        </select>

        <label for="iso14001">ISO 14001 Certificate:</label>
        <select name="iso14001" id="iso14001" required>
          <option value="VAR">Available</option>
          <option value="YOK">Not Available</option>
        </select>

        <label for="iso45001">ISO 45001 Certificate:</label>
        <select name="iso45001" id="iso45001" required>
          <option value="VAR">Available</option>
          <option value="YOK">Not Available</option>
        </select>

        <button type="submit" class="btn">Submit</button>
      </form>
    </div>
  </div>

</section>

</body>
</html>
