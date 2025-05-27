<?php
include "config.php";

// 1. Güncellenecek kayıt ID ile alınıyor
if (!isset($_GET['id'])) {
    echo "❌ Geçersiz ID!";
    exit;
}

$id = $_GET['id'];

// Güncelleme yapıldıysa:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tedarikci_id = $_POST['tedarikci_id'];
    $siparis_no = $_POST['siparis_no'];
    $talep_tarihi = $_POST['talep_tarihi'];
    $teslim_edildi = $_POST['teslim_edildi'];
    $teslim_tarihi = $_POST['teslim_tarihi'];
    $acil = $_POST['acil'];

    $sql = "UPDATE orders SET 
                tedarikci_id=?, 
                siparis_no=?, 
                talep_tarihi=?, 
                teslim_edildi=?, 
                teslim_tarihi=?, 
                acil=? 
            WHERE id=?";

    $stmt = $baglan->prepare($sql);
    $stmt->bind_param("isssssi", $tedarikci_id, $siparis_no, $talep_tarihi, $teslim_edildi, $teslim_tarihi, $acil, $id);

    if ($stmt->execute()) {
        echo "✅ Sipariş başarıyla güncellendi.";
        echo "<br><a href='orders_list.php'>Listeye Dön</a>";
    } else {
        echo "❌ Hata: " . $stmt->error;
    }

    $stmt->close();
    $baglan->close();
    exit;
}

// 2. Mevcut veriler veritabanından çekiliyor
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo "❌ Kayıt bulunamadı!";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Sipariş Güncelle</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f8ff;
      padding: 40px;
    }

    .form-box {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      max-width: 500px;
      margin: 0 auto;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #003366;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn {
      background-color: #00bfff;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 30px;
      cursor: pointer;
      transition: 0.3s;
      width: 100%;
    }

    .btn:hover {
      background-color: #007bb5;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Sipariş Güncelle</h2>
  <form method="POST">
    <label>Tedarikçi ID:</label>
    <input type="number" name="tedarikci_id" value="<?= $row['tedarikci_id'] ?>" required>

    <label>Sipariş No:</label>
    <input type="text" name="siparis_no" value="<?= $row['siparis_no'] ?>" required>

    <label>Talep Tarihi:</label>
    <input type="date" name="talep_tarihi" value="<?= $row['talep_tarihi'] ?>" required>

    <label>Teslim Edildi mi?</label>
    <select name="teslim_edildi" required>
      <option value="Evet" <?= $row['teslim_edildi'] == 'Evet' ? 'selected' : '' ?>>Evet</option>
      <option value="Hayir" <?= $row['teslim_edildi'] == 'Hayir' ? 'selected' : '' ?>>Hayır</option>
    </select>

    <label>Teslim Tarihi:</label>
    <input type="date" name="teslim_tarihi" value="<?= $row['teslim_tarihi'] ?>">

    <label>Acil mi?</label>
    <select name="acil" required>
      <option value="Evet" <?= $row['acil'] == 'Evet' ? 'selected' : '' ?>>Evet</option>
      <option value="Hayir" <?= $row['acil'] == 'Hayir' ? 'selected' : '' ?>>Hayır</option>
    </select>

    <button type="submit" class="btn">Güncelle</button>
  </form>
</div>

</body>
</html>
