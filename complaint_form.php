<?php
session_start();
if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complaint Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-image: url('images/Image 119_14_09.png');
      background-size: cover;
      background-position: center;
    }

    .container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(0,0,0,0.6);
    }

    .form-box {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 15px;
      width: 500px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }

    h2 {
      text-align: center;
      color: #003366;
      margin-bottom: 30px;
    }

    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
      color: #003366;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    textarea {
      height: 100px;
      resize: vertical;
    }

    .btn {
      margin-top: 20px;
      background-color: #00bfff;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 30px;
      font-size: 16px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #007bb5;
    }
  </style>
</head>
<body>

<div class="container">
  <form action="complaint_kaydet.php" method="POST" class="form-box">
    <h2>Complaint Form</h2>

    <label for="siparis_id">Order ID:</label>
    <input type="number" name="siparis_id" id="siparis_id" required>

    <label for="baslik">Complaint Title:</label>
    <input type="text" name="baslik" id="baslik" required>

    <label for="aciklama">Description:</label>
    <textarea name="aciklama" id="aciklama" required></textarea>

    <label for="kategori">Category:</label>
    <select name="kategori" id="kategori" required>
      <option value="Kalite">Quality</option>
      <option value="Teslim">Delivery</option>
      <option value="Iletisim">Communication</option>
    </select>

    <label for="tarih">Complaint Date:</label>
    <input type="date" name="tarih" id="tarih" required>

    <button type="submit" class="btn">Submit</button>
  </form>
</div>

</body>
</html>
