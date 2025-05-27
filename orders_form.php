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
  <title>Order Form - Erdem Marine</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-image: url('images/resim3.jpg');
      background-size: cover;
      background-position: center;
    }

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      flex-direction: column;
    }

    .logo-img {
      width: 500px;
      margin-bottom: 20px;
      
    }

    .form-box {
      background-color: rgba(0,0,0,0.75);
      padding: 40px;
      border-radius: 15px;
      width: 450px;
      color: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }

    .form-box input,
    .form-box select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: none;
    }

    .form-box label {
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

<div class="form-container">
  <img src="images/formlo.png" alt="Erdem Marine Logo" class="logo-img">

  <div class="form-box">
    <h2>Order Form</h2>
    <form action="orders_kaydet.php" method="POST">

      <input type="text" name="siparis_no" placeholder="Order Number" required>
      <label for="tedarikci_id">Supplier ID:</label>
      <input type="number" name="tedarikci_id" required>

      <label for="talep_tarihi">Request Date:</label>
      <input type="date" name="talep_tarihi" required>

      <label for="teslim_edildi">Delivered?</label>
      <select name="teslim_edildi" required>
        <option value="Evet">Yes</option>
        <option value="Hayir">No</option>
      </select>

      <label for="teslim_tarihi">Delivery Date:</label>
      <input type="date" name="teslim_tarihi">

      <label for="acil">Is it urgent?</label>
      <select name="acil" required>
        <option value="Evet">Yes</option>
        <option value="Hayir">No</option>
      </select>

      <button type="submit" class="btn">Save</button>
      <a href="orders_list.php" class="btn" style="display:inline-block; margin-top:15px;">📋 View Orders</a>

    </form>
  </div>
</div>
</body>
</html>
